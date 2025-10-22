<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) // tampil 2 kolom biar rapi
            ->components([
                TextInput::make('name')
                    ->label('Nama Warga')
                    ->placeholder('Masukkan nama lengkap warga')
                    ->required()
                    ->maxLength(255),

                TextInput::make('house_number')
                    ->label('Nomor Rumah')
                    ->placeholder('Contoh: A12')
                    ->maxLength(10)
                    ->required(),

                TextInput::make('phone')
                    ->label('Nomor Telepon')
                    ->placeholder('Contoh: 0812xxxxxxx')
                    ->tel()
                    ->maxLength(20)
                    ->required(),

                Select::make('status')
                    ->label('Status Warga')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif',
                    ])
                    ->default('active')
                    ->required(),
            ]);
    }
}