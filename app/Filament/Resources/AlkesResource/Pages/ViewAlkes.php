<?php

namespace App\Filament\Resources\AlkesResource\Pages;

use App\Filament\Resources\AlkesResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAlkes extends ViewRecord
{
    protected static string $resource = AlkesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
