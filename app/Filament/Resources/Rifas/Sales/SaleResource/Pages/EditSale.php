<?php

namespace App\Filament\Resources\Rifas\Sales\SaleResource\Pages;

use App\Filament\Resources\Rifas\Sales\SaleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSale extends EditRecord
{
    protected static string $resource = SaleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
