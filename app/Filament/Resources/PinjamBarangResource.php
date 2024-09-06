<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PinjamBarangResource\Pages;
use App\Filament\Resources\PinjamBarangResource\RelationManagers;
use App\Models\PinjamBarang;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PinjamBarangResource extends Resource
{
    protected static ?string $model = PinjamBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Peminjaman Barang';

    protected static ?string $pluralModelLabel = 'Peminjaman Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('barangJoin.nama_alat_kesehatan')
                    ->label('Nama Barang')
                    ->searchable(),
                TextColumn::make('pegawaiPinjamJoin.nama_pegawai')
                    ->label('Dipinjam Oleh')
                    ->searchable(),
                TextColumn::make('tanggal_pinjam')
                    ->label('Tanggal Pinjam')
                    ->sortable(),
                TextColumn::make('tanggal_kembali')
                    ->label('Tanggal Kembali / Hilang')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->color(fn(string $state): string => match ($state) {
                        'PINJAM' => 'warning',
                        'KEMBALI' => 'success',
                        'HILANG' => 'danger',
                    })
                    ->weight(FontWeight::SemiBold)
                    ->alignCenter()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('barang_kembali')
                    ->label('Kembali')
                    ->icon('heroicon-m-check')
                    ->color(Color::hex('#0D7C66'))
                    ->visible(fn($record) => $record->status === 'PINJAM')
                    ->action(function ($record) {
                        PinjamBarang::where('id', $record->id)
                            ->update([
                                'status' => 'KEMBALI',
                                'tanggal_kembali' => Carbon::now()
                            ]);
                    }),
                Action::make('barang_hilang')
                    ->label('Hilang')
                    ->icon('heroicon-m-trash')
                    ->color(Color::hex('#EF5A6F'))
                    ->visible(fn($record) => $record->status === 'PINJAM')
                    ->action(function ($record) {
                        PinjamBarang::where('id', $record->id)
                            ->update([
                                'status' => 'HILANG',
                                'tanggal_kembali' => Carbon::now()
                            ]);
                    }),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListPinjamBarangs::route('/'),
        ];
    }
}
