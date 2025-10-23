<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class WidgetExpenseChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Pengeluaran Bulanan';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(fn ($m) => Carbon::create()->month($m)->translatedFormat('F'));

        $expenses = collect(range(1, 12))->map(fn ($m) =>
            Transaction::where('type', 'expense')
                ->whereMonth('created_at', $m)
                ->whereYear('created_at', now()->year)
                ->sum('amount')
        );

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran',
                    'data' => $expenses,
                    'borderColor' => '#EF4444',
                    'backgroundColor' => 'rgba(239,68,68,0.2)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}