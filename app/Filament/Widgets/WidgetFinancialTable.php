<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;

class WidgetFinancialTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public ?string $report_type = 'Semua';
    public ?string $start_date = null;
    public ?string $end_date = null;

    #[On('filter-updated')]
    public function updateFilter($data): void
    {
        $this->report_type = $data['report_type'];
        $this->start_date = $data['start_date'];
        $this->end_date = $data['end_date'];
    }

    protected function getTableQuery(): Builder
    {
        return Transaction::query()
            ->when($this->report_type !== 'Semua', fn($q) => $q->where('type', $this->report_type))
            ->when($this->start_date && $this->end_date, fn($q) => $q->whereBetween('date', [$this->start_date, $this->end_date]))
            ->orderBy('date', 'desc');
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
                ->default('-'),

            Tables\Columns\TextColumn::make('description')
                ->label('Deskripsi')
                ->default('-')
                ->limit(40),

            Tables\Columns\BadgeColumn::make('type')
                ->label('Tipe')
                ->colors([
                    'success' => 'income',
                    'danger' => 'expense',
                ])
                ->formatStateUsing(fn($state) => ucfirst($state)),

            Tables\Columns\TextColumn::make('amount')
                ->label('Jumlah')
                ->money('IDR', true)
                ->alignment('right'),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }

    public static function canView(): bool
    {
        return request()->routeIs('filament.admin.pages.financial-report');
    }

}