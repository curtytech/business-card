<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    public static function getNavigationLabel(): string
    {
        return 'Criar usuário';
    }

    public static function shouldRegisterNavigation(array $parameters = []): bool
    {
        return auth()->check() && auth()->user()->role !== 'user';
    }

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