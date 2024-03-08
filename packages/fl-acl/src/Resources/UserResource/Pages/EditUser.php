<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Acl\Resources\UserResource\Pages;

use Callcocam\Acl\Resources\UserResource;
use Callcocam\Acl\Traits\HasEditorColumn;
use Callcocam\Acl\Traits\HasPasswordCreateOrUpdate;
use Callcocam\Acl\Traits\HasStatusColumn;
use Callcocam\Acl\Traits\HasUserFormSchema;
use Callcocam\Tenant\Traits\HasUploadFormField;
use Filament\Actions; 
use Filament\Forms\Components\Section; 
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord; 

class EditUser extends EditRecord
{
    use HasStatusColumn, HasEditorColumn, HasPasswordCreateOrUpdate, HasUploadFormField, HasUserFormSchema;

    protected static string $resource = UserResource::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema(function(){

                    $contents = $this->userFormSchema();

                    return $contents;

                })->columns(12)
            ])->columns(12);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        return array_filter($data);
    }
}
