<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Tenant\Resources\TenantResource\Pages;
 
use Callcocam\Tenant\Resources\TenantResource;
use Callcocam\Tenant\Traits\HasDatesFormForTableColums;
use Callcocam\Tenant\Traits\HasEditorColumn;
use Callcocam\Tenant\Traits\HasStatusColumn;
use Callcocam\Tenant\Traits\HasTenantSchemaForm;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;
use Filament\Forms\Form;

class EditTenant extends EditRecord
{
    use HasStatusColumn, HasEditorColumn, HasDatesFormForTableColums, HasTenantSchemaForm;
    
    protected static string $resource = TenantResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema(function () {
                $contents = $this->getTenantSchemaFrom(); 

                $contents[] =  static::getStatusFormRadioField();
                $contents[] = static::getEditorFormField();

                return $contents;
            })->columns(12);
    }
 
}
