<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions; 
class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Salvar')
                ->submit('save'),

            Actions\Action::make('cancel')
                ->label('Cancelar')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray'),
        ];
    }
}
