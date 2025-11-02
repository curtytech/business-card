<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Usuários';
    protected static ?string $pluralModelLabel = 'Usuários';
    protected static ?string $modelLabel = 'Usuário';
    protected static ?string $navigationGroup = 'Gerenciamento';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Section::make('Informações Básicas')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nome')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(table: 'users', column: 'email', ignoreRecord: true),
                    ]),

                Section::make('Autenticação')
                    ->columns(2)
                    ->schema([
                        TextInput::make('password')
                            ->label('Senha')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context) => $context === 'create'),
                    ]),

                Section::make('Imagens e Cores')
                    ->columns(2)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Imagem')
                            ->image()
                            ->disk('public')
                            ->directory('users'),

                        FileUpload::make('cover_image')
                            ->label('Imagem de capa')
                            ->image()
                            ->disk('public')
                            ->directory('users'),

                        ColorPicker::make('primary_color')
                            ->label('Cor primária'),

                        ColorPicker::make('secondary_color')
                            ->label('Cor secundária'),
                    ]),

                Section::make('Template')
                    ->schema([
                        Select::make('template')
                            ->label('Template')
                            ->options([
                                'default' => 'Padrão',
                                'modern' => 'Moderno',
                                'classic' => 'Clássico',
                            ])
                            ->native(false)
                            ->nullable(),
                    ]),

                Section::make('Redes sociais')
                    ->columns(2)
                    ->schema([
                        TextInput::make('facebook')->label('Facebook')->maxLength(255)->nullable(),
                        TextInput::make('instagram')->label('Instagram')->maxLength(255)->nullable(),
                        TextInput::make('twitter')->label('Twitter/X')->maxLength(255)->nullable(),
                        TextInput::make('linkedin')->label('LinkedIn')->maxLength(255)->nullable(),
                        TextInput::make('whatsapp')->label('WhatsApp')->maxLength(255)->nullable(),
                    ]),

                Section::make('Contato e Endereço')
                    ->columns(2)
                    ->schema([
                        TextInput::make('phone')->label('Telefone')->maxLength(255)->nullable(),
                        TextInput::make('address')->label('Endereço')->maxLength(255)->nullable(),
                        TextInput::make('number')->label('Número')->maxLength(255)->nullable(),
                        TextInput::make('neighborhood')->label('Bairro')->maxLength(255)->nullable(),
                        TextInput::make('city')->label('Cidade')->maxLength(255)->nullable(),
                        TextInput::make('state')->label('Estado')->maxLength(255)->nullable(),
                        TextInput::make('country')->label('País')->maxLength(255)->nullable(),
                        TextInput::make('zipcode')->label('CEP')->maxLength(255)->nullable(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->circular()
                    ->toggleable(),

                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Telefone')
                    ->toggleable()
                    ->searchable(),

                TextColumn::make('city')
                    ->label('Cidade')
                    ->toggleable(),

                TextColumn::make('state')
                    ->label('Estado')
                    ->toggleable(),

                TextColumn::make('template')
                    ->label('Template')
                    ->badge()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('template')
                    ->options([
                        'default' => 'Padrão',
                        'modern' => 'Moderno',
                        'classic' => 'Clássico',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}