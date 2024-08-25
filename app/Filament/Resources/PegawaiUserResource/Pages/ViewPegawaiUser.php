<?php

namespace App\Filament\Resources\PegawaiUserResource\Pages;

use App\Filament\Resources\PegawaiUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPegawaiUser extends ViewRecord
{
    protected static string $resource = PegawaiUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
