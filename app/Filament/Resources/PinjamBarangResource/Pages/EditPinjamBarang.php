<?php

namespace App\Filament\Resources\PinjamBarangResource\Pages;

use App\Filament\Resources\PinjamBarangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPinjamBarang extends EditRecord
{
    protected static string $resource = PinjamBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
