<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\WidgetBalanceChart;
use App\Filament\Widgets\WidgetIncomeChart;
use App\Filament\Widgets\WidgetExpenseChart;
use App\Filament\Widgets\LatestTransactions;
use Filament\Support\Icons\Heroicon;
use BackedEnum;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon =  Heroicon::OutlinedHome;
    protected static ?int $navigationSort = 1;



    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            WidgetBalanceChart::class,
            WidgetIncomeChart::class,
            WidgetExpenseChart::class,
            LatestTransactions::class,
        ];
    }

    public function getColumns(): int | array
    {
        return [
            'default' => 2,
            'sm' => 1,
            'lg' => 2,
            'xl' => 2,
        ];
    }
}