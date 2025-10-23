<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class WidgetBalanceChart extends ChartWidget
{
    protected ?string $heading = 'Perbandingan Pemasukan vs Pengeluaran';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $months = collect(range(1, 12))->map(fn ($m) => Carbon::create()->month($m)->translatedFormat('F'));

        $income = collect(range(1, 12))->map(fn ($m) =>
            Transaction::where('type', 'income')
                ->whereMonth('created_at', $m)
                ->whereYear('created_at', now()->year)
                ->sum('amount')
        );

        $expense = collect(range(1, 12))->map(fn ($m) =>
            Transaction::where('type', 'expense')
                ->whereMonth('created_at', $m)
                ->whereYear('created_at', now()->year)
                ->sum('amount')
        );

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $income,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.8)',
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $expense,
                    'backgroundColor' => 'rgba(239, 68, 68, 0.8)',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}