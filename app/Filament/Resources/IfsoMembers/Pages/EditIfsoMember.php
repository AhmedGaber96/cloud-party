<?php

namespace App\Filament\Resources\IfsoMembers\Pages;

use App\Filament\Resources\IfsoMembers\IfsoMemberResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIfsoMember extends EditRecord
{
    protected static string $resource = IfsoMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()->icon('heroicon-o-trash'),
            Action::make('sendEmail')
            ->label('Send Email')
            ->icon('heroicon-o-envelope')
            ->color('primary')
            
        ];


    }
    

    
}
