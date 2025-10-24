<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Transaction;
use Livewire\Attributes\On;

class WidgetFinancialSummary extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public ?string $report_type = 'Semua';
    public ?string $start_date = null;
    public ?string $end_date = null;

    #[On('filter-updated')]
    public function updateFilter($data)
    {
        $this->report_type = $data['report_type'];
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'];
    }

    protected function getStats(): array
    {
        $query = Transaction::query()
            ->when($this->report_type !== 'Semua', fn($q) => $q->where('type', $this->report_type))
            ->when($this->start_date && $this->end_date, fn($q) => $q->whereBetween('date', [$this->start_date, $this->end_date]));

        $income = (clone $query)->where('type', 'income')->sum('amount');
        $expense = (clone $query)->where('type', 'expense')->sum('amount');
        $count = (clone $query)->count();

        return [
            Stat::make('Total Pemasukan', 'Rp ' . number_format($income, 0, ',', '.'))
                ->description('Bulan ini')
                ->descriptionColor('success')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Total Pengeluaran', 'Rp ' . number_format($expense, 0, ',', '.'))
                ->description('Bulan ini')
                ->descriptionColor('danger')
                ->icon('heroicon-o-arrow-trending-down'),

            Stat::make('Total Transaksi', number_format($count))
                ->description('Bulan ini')
                ->descriptionColor('info')
                ->icon('heroicon-o-clipboard-document-list'),
        ];
    }

    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.pages.financial-report');
    }

}