<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class WidgetIncomeChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Pemasukan Bulanan';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(fn ($m) => Carbon::create()->month($m)->translatedFormat('F'));

        $incomes = collect(range(1, 12))->map(fn ($m) =>
            Transaction::where('type', 'income')
                ->whereMonth('created_at', $m)
                ->whereYear('created_at', now()->year)
                ->sum('amount')
        );

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $incomes,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16,185,129,0.2)',
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