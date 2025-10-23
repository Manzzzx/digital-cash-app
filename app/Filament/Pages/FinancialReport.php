<?php

namespace App\Filament\Pages;

use App\Models\Transaction;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialReportExport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use BackedEnum;

class FinancialReport extends Page implements Forms\Contracts\HasForms, HasTable
{
    use Forms\Concerns\InteractsWithForms;
    use Tables\Concerns\InteractsWithTable;

    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?string $navigationLabel = 'Laporan Keuangan';
    protected static ?string $title = 'Laporan Keuangan';
    protected string $view = 'filament.pages.financial-report';

    // filter properties (bind ke form)
    public ?string $report_type = 'Semua';
    public ?string $start_date = null;
    public ?string $end_date = null;

    // summary values
    public int|float $total_income = 0;
    public int|float $total_expense = 0;
    public int $total_transactions = 0;

    // transactions collection for blade (table render)
    public $transactions = [];

    public function mount(): void
    {
        $this->start_date = Carbon::now()->startOfMonth()->toDateString();
        $this->end_date = Carbon::now()->toDateString();
        $this->getFilteredTransactions(); // init
    }

    // Filament 4: supply form schema for page
    protected function getFormSchema(): array
    {
        return [
            Select::make('report_type')
                ->label('Tipe Laporan')
                ->options([
                    'Semua' => 'Semua',
                    'income' => 'Pemasukan',
                    'expense' => 'Pengeluaran',
                ])
                ->default('Semua'),

            DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required(),

            DatePicker::make('end_date')
                ->label('Tanggal Akhir')
                ->required(),
        ];
    }

    // InteractsWithTable hooks: query/columns
    protected function getTableQuery(): Builder
    {
        // return builder (no ->get())
        return $this->getFilteredTransactions();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('date')
                ->label('Tanggal')
                ->date('d M Y')
                ->sortable(),

            Tables\Columns\TextColumn::make('category.name')
                ->label('Kategori')
                ->searchable(),

            Tables\Columns\TextColumn::make('description')
                ->label('Deskripsi')
                ->limit(60),

            Tables\Columns\BadgeColumn::make('type')
                ->label('Tipe')
                ->colors([
                    'success' => 'income',
                    'danger' => 'expense',
                ])
                ->formatStateUsing(fn (string $state) => ucfirst($state)),

            Tables\Columns\TextColumn::make('amount')
                ->label('Jumlah')
                ->money('IDR')
                ->alignment('right')
                ->sortable(),
        ];
    }

    // called when user submits filter (form)
    public function submit(): void
    {
        $this->getFilteredTransactions();
    }

    // central query and summary calculation
    private function getFilteredTransactions(): Builder
    {
        // ensure dates exist
        $start = $this->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $end = $this->end_date ?? Carbon::now()->toDateString();

        $query = Transaction::with('category')
            ->when($this->report_type !== 'Semua', fn($q) => $q->where('type', $this->report_type))
            ->whereBetween('date', [$start, $end])
            ->orderBy('date', 'asc');

        $rows = $query->get();

        // fill page-level properties for blade rendering
        $this->transactions = $rows;
        $this->total_income = $rows->where('type', 'income')->sum('amount');
        $this->total_expense = $rows->where('type', 'expense')->sum('amount');
        $this->total_transactions = $rows->count();

        return $query;
    }

    protected function getActions(): array
    {
        return [
            Action::make('Export Excel')
                ->button()
                ->color('success')
                ->icon('heroicon-o-document-arrow-down')
                ->action(fn () => $this->exportExcel()),

            Action::make('Export PDF')
                ->button()
                ->color(Color::Red)
                ->icon('heroicon-o-document')
                ->action(fn () => $this->exportPdf()),
        ];
    }

    public function exportExcel()
    {
        $rows = $this->getFilteredTransactions()->get();

        return Excel::download(
            new FinancialReportExport($rows, $this->start_date, $this->end_date, $this->report_type),
            "Laporan_Keuangan_{$this->start_date}_sampai_{$this->end_date}.xlsx"
        );
    }

    public function exportPdf()
    {
        $rows = $this->getFilteredTransactions()->get();

        $pdf = Pdf::loadView('pdf.financial-report', [
            'transactions' => $rows,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'total_income' => $this->total_income,
            'total_expense' => $this->total_expense,
            'total_transactions' => $this->total_transactions,
        ])->setPaper('a4', 'portrait');

        return response()->streamDownload(fn () => print($pdf->output()), "Laporan_Keuangan_{$this->start_date}_sampai_{$this->end_date}.pdf");
    }
}