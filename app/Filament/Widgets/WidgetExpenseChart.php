<?php

namespace App\Filament\Widgets;

use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;
use App\Models\Transaction;
use Carbon\Carbon;

class WidgetExpenseChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Pengeluaran Bulanan';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        // Ambil total pengeluaran per bulan berdasarkan kolom `date`
        $data = Transaction::select(
                DB::raw('MONTH(date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('type', 'expense')
            ->whereYear('date', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Buat array bulan lengkap 1–12
        $months = collect(range(1, 12))->map(fn($m) => Carbon::create()->month($m)->translatedFormat('M'))->toArray();

        // Mapping nilai pengeluaran per bulan
        $expense = [];
        foreach (range(1, 12) as $m) {
            $found = $data->firstWhere('month', $m);
            $expense[] = $found ? $found->total : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengeluaran',
                    'data' => $expense,
                    'borderColor' => '#EF4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.3)',
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