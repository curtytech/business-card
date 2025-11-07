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
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Models\Template;

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
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Set $set) {
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('ex: joao-silva')
                            ->helperText('Use apenas letras e números; espaços viram "-".')
                            ->rule('regex:/^[a-z0-9-]+$/')
                            ->unique(table: 'users', column: 'slug', ignoreRecord: true)
                            ->dehydrateStateUsing(fn ($state) => Str::slug((string) $state)),
                    ]),

                Section::make('Autenticação')
                    ->columns(2)
                    ->schema([
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->required()
                            ->unique(table: 'users', column: 'email', ignoreRecord: true),
                        TextInput::make('password')
                            ->label('Senha')
                            ->password()
                            ->revealable()
                            ->dehydrateStateUsing(fn($state) => filled($state) ? bcrypt($state) : null)
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context) => $context === 'create'),

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
                            ->options(fn () => Template::query()
                                ->orderBy('name')
                                ->pluck('name', 'name')
                                ->toArray())
                            ->searchable()
                            ->preload()
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

                Section::make('Outras redes sociais')
                    ->columns(1)
                    ->schema([
                        KeyValue::make('other_social_networks')
                            ->label('Outras redes sociais')
                            ->keyLabel('Nome da rede')
                            ->valueLabel('URL')
                            ->keyPlaceholder('YouTube')
                            ->valuePlaceholder('https://exemplo.com/seu-perfil')
                            ->addButtonLabel('Adicionar')
                            ->deleteButtonLabel('Remover')
                            ->reorderable()
                            ->nullable(),
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
                    ->options(fn () => Template::query()
                        ->orderBy('name')
                        ->pluck('name', 'name')
                        ->toArray()),
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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (auth()->check() && auth()->user()->role === 'user') {
            return $query->whereKey(auth()->id());
        }

        return $query;
    }

    public static function canViewAny(): bool
    {
        return auth()->check();
    }

    public static function canCreate(): bool
    {
        return auth()->check() && auth()->user()->role !== 'user';
    }

    public static function canEdit(Model $record): bool
    {
        if (! auth()->check()) {
            return false;
        }

        if (auth()->user()->role !== 'user') {
            return true; // admin ou outros papéis podem editar
        }

        return $record->getKey() === auth()->id();
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->check() && auth()->user()->role !== 'user';
    }
}
