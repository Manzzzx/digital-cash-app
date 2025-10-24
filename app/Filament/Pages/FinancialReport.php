<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Support\Colors\Color;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialReportExport;
use App\Models\Transaction;
use Livewire\Attributes\On;
use Carbon\Carbon;
use BackedEnum;

class FinancialReport extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-document-chart-bar';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Laporan Keuangan';
    protected static ?string $title = 'Laporan Keuangan';
    protected string $view = 'filament.pages.financial-report';
    public ?string $report_type = 'Semua';
    public ?string $start_date = null;
    public ?string $end_date = null;

    public function mount(): void
    {
        $this->start_date = Carbon::now()->startOfMonth()->toDateString();
        $this->end_date = Carbon::now()->toDateString();
    }

    #[On('filter-updated')]
    public function updateFilter($data): void
    {
        $this->report_type = $data['report_type'];
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'];
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('Export Excel')
                ->label('Export Excel')
                ->color('success')
                ->icon('heroicon-o-document-arrow-down')
                ->action(fn() => $this->exportExcel()),

            Action::make('Export PDF')
                ->label('Export PDF')
                ->color(Color::Red)
                ->icon('heroicon-o-document')
                ->action(fn() => $this->exportPdf()),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\WidgetFinancialFilter::class,
            \App\Filament\Widgets\WidgetFinancialSummary::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            \App\Filament\Widgets\WidgetFinancialTable::class,
        ];
    }

    public function exportExcel()
    {
        $start = $this->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $end = $this->end_date ?? Carbon::now()->toDateString();
        $type = $this->report_type ?? 'Semua';

        $transactions = Transaction::query()
            ->when($type !== 'Semua', fn($q) => $q->where('type', $type))
            ->whereBetween('date', [$start, $end])
            ->get();

        return Excel::download(
            new FinancialReportExport($transactions, $start, $end, $type),
            "Laporan_Keuangan_{$start}_sampai_{$end}.xlsx"
        );
    }

    public function exportPdf()
    {
        $start = $this->start_date ?? Carbon::now()->startOfMonth()->toDateString();
        $end = $this->end_date ?? Carbon::now()->toDateString();
        $type = $this->report_type ?? 'Semua';

        $transactions = Transaction::query()
            ->when($type !== 'Semua', fn($q) => $q->where('type', $type))
            ->whereBetween('date', [$start, $end])
            ->get();

        $pdf = Pdf::loadView('pdf.financial-report', [
            'transactions' => $transactions,
            'start_date' => $start,
            'end_date' => $end,
            'report_type' => $type,
            'total_income' => $transactions->where('type', 'income')->sum('amount'),
            'total_expense' => $transactions->where('type', 'expense')->sum('amount'),
            'total_transactions' => $transactions->count(),
        ])->setPaper('a4', 'portrait');


        return response()->streamDownload(
            fn() => print($pdf->output()),
            "Laporan_Keuangan_{$start}_sampai_{$end}.pdf"
        );
    }
}