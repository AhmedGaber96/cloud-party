<?php

namespace App\Filament\Resources\IfsoMembers\Pages;

use App\Filament\Resources\IfsoMembers\IfsoMemberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIfsoMembers extends ListRecords
{
    protected static string $resource = IfsoMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
