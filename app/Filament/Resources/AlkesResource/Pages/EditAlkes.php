<?php

namespace App\Filament\Resources\AlkesResource\Pages;

use App\Filament\Resources\AlkesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAlkes extends EditRecord
{
    protected static string $resource = AlkesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
