<?php

namespace App\Filament\Resources\Members;

use App\Filament\Resources\Members\Pages\CreateMember;
use App\Filament\Resources\Members\Pages\EditMember;
use App\Filament\Resources\Members\Pages\ListMembers;
use App\Filament\Resources\Members\Schemas\MemberForm;
use App\Filament\Resources\Members\Tables\MembersTable;
use App\Models\Member;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use UnitEnum;
use BackedEnum;

class MemberResource extends Resource
{
    /** 
     * Model yang digunakan oleh resource ini 
     */
    protected static ?string $model = Member::class;

    /** 
     * Grup navigasi di sidebar admin panel 
     * Bisa enum (UnitEnum) atau string biasa
     */
    protected static UnitEnum|string|null $navigationGroup = 'Data Master';

    /** 
     * Ikon navigasi di sidebar (Filament 4 pakai BackedEnum)
     */
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUserGroup;

    /** 
     * Field yang akan ditampilkan sebagai judul di UI (breadcrumbs, dll.)
     */
    protected static ?string $recordTitleAttribute = 'name';

    /** 
     * Menentukan schema form (didefinisikan di MemberForm)
     */
    public static function form(Schema $schema): Schema
    {
        return MemberForm::configure($schema);
    }

    /** 
     * Menentukan tabel (didefinisikan di MembersTable)
     */
    public static function table(Table $table): Table
    {
        return MembersTable::configure($table);
    }

    /** 
     * Relasi tambahan (jika nanti ada relasi seperti transaksi)
     */
    public static function getRelations(): array
    {
        return [];
    }

    /** 
     * Routing halaman CRUD
     */
    public static function getPages(): array
    {
        return [
            'index' => ListMembers::route('/'),
            'create' => CreateMember::route('/create'),
            'edit' => EditMember::route('/{record}/edit'),
        ];
    }
}