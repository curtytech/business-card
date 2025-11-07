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
}