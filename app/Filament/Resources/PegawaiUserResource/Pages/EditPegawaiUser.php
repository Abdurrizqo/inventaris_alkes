<?php

namespace App\Filament\Resources\PegawaiUserResource\Pages;

use App\Filament\Resources\PegawaiUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPegawaiUser extends EditRecord
{
    protected static string $resource = PegawaiUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
