<?php

namespace App\Filament\Resources\IfsoMembers;

use App\Filament\Resources\IfsoMembers\Pages\CreateIfsoMember;
use App\Filament\Resources\IfsoMembers\Pages\EditIfsoMember;
use App\Filament\Resources\IfsoMembers\Pages\ListIfsoMembers;
use App\Filament\Resources\IfsoMembers\Schemas\IfsoMemberForm;
use App\Filament\Resources\IfsoMembers\Tables\IfsoMembersTable;
use App\Models\IfsoMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IfsoMemberResource extends Resource
{
    protected static ?string $model = IfsoMember::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'IfsoMember';

    public static function form(Schema $schema): Schema
    {
        return IfsoMemberForm::configure($schema);
    }
  public static function getNavigationBadge(): ?string
{
    $user = filament()->auth()->user();

    if ($user?->hasRole('reviwer')) {
        return static::getModel()::where('reviewer_id', $user->id)->count();
    }

    // admin يشوف الكل
    return static::getModel()::count();
}
    // public static function getNavigationBadgeColor(): string|array|null
    // {
    //     return 'danger';
    // }


public static function getEloquentQuery(): Builder
{
    $query = parent::getEloquentQuery();

    if (filament()->auth()->user()?->hasRole('reviwer')) {

        $query->where('reviewer_id', filament()->auth()->id());
    }
        
    return $query;
}

    public static function table(Table $table): Table
    {
        return IfsoMembersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListIfsoMembers::route('/'),
            'create' => CreateIfsoMember::route('/create'),
            'edit' => EditIfsoMember::route('/{record}/edit'),
        ];
    }
}
