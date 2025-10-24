<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Filament\Forms;
use Filament\Forms\Form;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\FinancialReportExport;
use App\Models\Transaction;
use Carbon\Carbon;

class WidgetFinancialFilter extends Widget implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected string $view = 'filament.widgets.widget-financial-filter';
    protected int|string|array $columnSpan = 'full';

    public ?string $report_type = 'Semua';
    public ?string $start_date = null;
    public ?string $end_date = null;

    public function mountForm(): void
    {
        $this->form->fill([
            'report_type' => 'Semua',
            'start_date' => Carbon::now()->startOfMonth()->toDateString(),
            'end_date' => Carbon::now()->toDateString(),
        ]);
    }

    public function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('report_type')
                ->label('Tipe Laporan')
                ->options([
                    'Semua' => 'Semua',
                    'income' => 'Pemasukan',
                    'expense' => 'Pengeluaran',
                ])
                ->default('Semua'),

            Forms\Components\DatePicker::make('start_date')
                ->label('Tanggal Mulai')
                ->required(),

            Forms\Components\DatePicker::make('end_date')
                ->label('Tanggal Akhir')
                ->required(),
        ];
    }

    public function applyFilter(): void
    {
        $data = $this->form->getState();

        $this->dispatch('filter-updated', [
            'report_type' => $data['report_type'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
    }

    #[On('reset-filters')]
    public function resetFilters(): void
    {
        $this->mountForm();
    }

    public function exportExcel()
    {
        $transactions = $this->getFilteredTransactions()->get();

        return Excel::download(
            new FinancialReportExport(
                $transactions,
                $this->start_date,
                $this->end_date,
                $this->report_type
            ),
            "Laporan_Keuangan_{$this->start_date}_sampai_{$this->end_date}.xlsx"
        );
    }

    public function exportPdf()
    {
        $pdf = Pdf::loadView('pdf.financial-report', [
            'transactions' => $this->getFilteredTransactions()->get(),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ])->setPaper('a4', 'portrait');

        return response()->streamDownload(fn () => print($pdf->output()), "Laporan_Keuangan.pdf");
    }

    private function getFilteredTransactions()
    {
        return Transaction::query()
            ->when($this->report_type !== 'Semua', fn($q) => $q->where('type', $this->report_type))
            ->whereBetween('date', [$this->start_date, $this->end_date]);
    }

    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.pages.financial-report');
    }

}