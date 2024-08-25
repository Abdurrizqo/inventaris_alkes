<?php

namespace App\Filament\Resources\AlkesResource\Pages;

use App\Filament\Resources\AlkesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAlkes extends ListRecords
{
    protected static string $resource = AlkesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
