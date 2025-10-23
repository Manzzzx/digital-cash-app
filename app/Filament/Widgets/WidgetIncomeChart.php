<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class WidgetIncomeChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Pemasukan Bulanan';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // Ambil total pemasukan per bulan berdasarkan kolom `date`
        $data = Transaction::select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('type', 'income')
            ->whereYear('date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Buat array bulan lengkap 1–12
        $months = collect(range(1, 12))->map(fn($m) => Carbon::create()->month($m)->translatedFormat('M'))->toArray();

        // Mapping nilai pemasukan per bulan
        $income = [];
        foreach (range(1, 12) as $m) {
            $found = $data->firstWhere('month', $m);
            $income[] = $found ? $found->total : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $income,
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.3)',
                    'fill' => true,
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