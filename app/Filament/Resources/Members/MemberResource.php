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
    protected static ?string $model = Member::class;
    // protected static UnitEnum|string|null $navigationGroup = 'Data Master';
    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUserGroup;
    
    protected static ?string $pluralModelLabel = 'Anggota';
    protected static ?string $modelLabel = 'Anggota';
    protected static ?string $navigationLabel = 'Data Anggota';
    protected static ?string $recordTitleAttribute = 'name';
    public static function form(Schema $schema): Schema
    {
        return MemberForm::configure($schema);
    }
    public static function table(Table $table): Table
    {
        return MembersTable::configure($table);
    }
    public static function getRelations(): array
    {
        return [];
    }
    public static function getPages(): array
    {
        return [
            'index' => ListMembers::route('/'),
            'create' => CreateMember::route('/create'),
            'edit' => EditMember::route('/{record}/edit'),
        ];
    }
}