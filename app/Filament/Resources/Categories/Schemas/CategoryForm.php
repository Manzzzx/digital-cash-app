<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('name')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255),
                Select::make('type')
                    ->label('Tipe')
                    ->options([
                        'income' => 'Pemasukan',
                        'expense' => 'Pengeluaran',
                    ])
                    ->default('income')
                    ->required(),
                FileUpload::make('image')
                    ->label('Gambar')
                    ->directory('categories')
                    ->disk('public')
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->dehydrateStateUsing(fn ($state) => is_array($state) ? $state[0] ?? null : $state)
                    ->required(),
            ]);
    }}