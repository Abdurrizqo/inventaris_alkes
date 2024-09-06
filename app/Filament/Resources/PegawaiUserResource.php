<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiUserResource\Pages;
use App\Filament\Resources\PegawaiUserResource\RelationManagers;
use App\Models\PegawaiUser;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class PegawaiUserResource extends Resource
{
    protected static ?string $model = PegawaiUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('pegawai')
                    ->relationship('pegawaiJoin', 'nama_pegawai')
                    ->label('Pegawai')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('username')
                    ->required()
                    ->minLength(6)
                    ->maxLength(40),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create')
                    ->minLength(6)
                    ->maxLength(12),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pegawaiJoin.nik')
                    ->label('NIK')
                    ->searchable(),
                TextColumn::make('pegawaiJoin.nama_pegawai')
                    ->label('Nama Pegawai')
                    ->searchable(),
                TextColumn::make('username')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListPegawaiUsers::route('/'),
            'create' => Pages\CreatePegawaiUser::route('/create'),
            'view' => Pages\ViewPegawaiUser::route('/{record}'),
            'edit' => Pages\EditPegawaiUser::route('/{record}/edit'),
        ];
    }
}
