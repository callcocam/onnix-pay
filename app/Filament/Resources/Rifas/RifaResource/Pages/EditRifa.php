<?php

namespace App\Filament\Resources\Rifas\RifaResource\Pages;

use App\Filament\Resources\Rifas\RifaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRifa extends EditRecord
{
    protected static string $resource = RifaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
