<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;
use App\Models\Category;


class TransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->columns(2)
        ->components([
            TextInput::make('reference_number')
            ->label('Nomor Referensi')
            ->disabled()
            ->dehydrated()
            ->default(function () {
                $year = now()->format('Y');
                $lastNumber = \App\Models\Transaction::whereYear('created_at', $year)
                    ->selectRaw('MAX(CAST(SUBSTRING_INDEX(reference_number, "-", -1) AS UNSIGNED)) as last')
                    ->value('last');
                $nextNumber = str_pad(($lastNumber ?? 0) + 1, 5, '0', STR_PAD_LEFT);
                return "TRX-{$year}-{$nextNumber}";
            }),
            
            DatePicker::make('date')
                ->label('Tanggal')
                ->default(now())
                ->required(),
                
            Select::make('category_id')
            ->label('Kategori')
            ->options(Category::pluck('name', 'id'))
            ->searchable()
            ->reactive()
                ->afterStateUpdated(function ($state, Set $set) {
                    $category = Category::find($state);
                    if ($category) {
                            $set('type', $category->type);
                            $set('type_label', $category->type === 'income' ? 'Pemasukan' : 'Pengeluaran');
                        } else {
                            $set('type', null);
                            $set('type_label', null);
                        }
                    })
                    ->required(),
                    
            TextInput::make('type_label')
                ->label('Tipe')
                ->disabled()
                ->dehydrated(false)
                ->reactive()
                ->prefixIcon(fn (Get $get) => match ($get('type')) {
                    'income' => 'heroicon-o-arrow-trending-up',
                    'expense' => 'heroicon-o-arrow-trending-down',
                    default => null,
                })
                ->prefixIconColor(fn (Get $get) => match ($get('type')) {
                    'income' => 'success',
                    'expense' => 'danger',
                    default => 'gray',
                })
                ->extraAttributes(fn (Get $get) => [
                    'class' => match ($get('type')) {
                        'income' => 'text-green-400 font-medium',
                        'expense' => 'text-red-400 font-medium',
                        default => 'text-gray-400 italic',
                    },
                ])
                ->default(fn (Get $get) => match ($get('type')) {
                    'income' => 'Pemasukan',
                    'expense' => 'Pengeluaran',
                    default => null,
                })
                ->placeholder('Tipe akan otomatis terisi'),

                Hidden::make('type')
                    ->dehydrated(),
                
                TextInput::make('amount')
                    ->label('Jumlah (Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                    
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull()
                    ->required(),
                    
                FileUpload::make('receipt')
                    ->label('Upload Bukti')
                    ->directory('transactions/receipts')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->maxSize(2048)
                    ->columnSpanFull(),
            ]);
    }
}