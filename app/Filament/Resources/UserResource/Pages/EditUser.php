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
            Actions\Action::make('deleteAccount')
                ->label('Excluir minha conta')
                ->color('danger')
                ->requiresConfirmation()
                ->visible(fn () => auth()->check() && auth()->user()->role === 'user')
                ->action(function () {
                    $user = $this->record;
                    auth()->logout();
                    $user->delete();
                    return redirect('/');
                }),

            Actions\Action::make('save')
                ->label('Salvar alterações')
                ->submit('save'),

            Actions\Action::make('cancel')
                ->label('Cancelar')
                ->url($this->getResource()::getUrl('index'))
                ->color('gray'),
        ];
    }
}
