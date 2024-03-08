<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Tenant\Traits;

use App\Core\Helpers\Helper;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Illuminate\Support\Str;

trait HasUploadFormField
{
    use FilesProcessing;

    public static function getUploadFormFieldset($name = 'file', $path = 'tenant', $ns='tenant')
    {
        return Fieldset::make($name)
            ->label(__(sprintf('%s::%s.forms.%s.fieldset', $ns, $path,  $name)))
            ->columns(2)
            ->schema([
                static::getUploadFormField($name)
                    ->label(__(sprintf('%s::%s.forms.%s.label', $ns, $path, $name)))
                    ->placeholder(__(sprintf('%s::%s.forms.%s.placeholder', $ns, $path, $name)))
                    ->helperText(config(sprintf('%s.forms.%s.helper_text',   $ns, $name), null))
                    ->imageEditor(config(sprintf('%s.forms.%s.image_editor', $ns, $name), true))
                    ->disk(config('filesystems.default', 'public'))
                    ->downloadable(config(sprintf('%s.forms.%s.downloadable', $ns, $name), true))
                    ->openable(config(sprintf('%s.forms.%s.openable', $ns, $name), true)),
                static::getUploadUrlFormField(sprintf("external_%s", $name), $name)
                    ->label(__(sprintf('%s::%s.forms.%s.label', $ns, $path, sprintf("external_%s", $name))))
                    ->placeholder(__(sprintf('%s::%s.forms.%s.placeholder', $ns, $path, sprintf("external_%s", $name))))
                    ->helperText(config(sprintf('%s.forms.%s.helper_text', $ns, sprintf("external_%s", $name)), null)),
            ]);
    }


    public static function getUploadFormField($name = 'file')
    {

        return FileUpload::make($name)
            ->columnSpanFull();
    }

    public static function getUploadUrlFormField($name = 'external_file', $file = 'file')
    {

        return TextInput::make($name)
            ->columnSpanFull()
            ->suffixAction(
                Action::make('uploadExternalFile')
                    ->label('Upload Externo')
                    ->icon('heroicon-m-clipboard')
                    ->requiresConfirmation()
                    ->action(function (Set $set, $state) use ($file) {
                        $name = Str::afterLast($state, '/');
                        $ext = Str::afterLast($name, '.');
                        $name = Str::beforeLast($name, '.');
                        $name = Str::slug($name);
                        $name = sprintf("%s/%s", get_tenant_id(), $name, $ext);
                        $result =  static::downloadFileFromUrl($state, $name);
                        if ($result) {
                            $set($file, $result);
                        }
                    })
            )
            ->maxLength(255);
    }

    public static function getUploadUrlFormFieldText($name = 'external_file', $file = 'file')
    {

        return TextInput::make($name)
            ->label('Url Externa do Arquivo (Opcional)')
            ->placeholder('https://www.google.com.br/arquivo.pdf')
            ->helperText('Informe a url do arquivo externo, de um arquivo hospedado em outro servidor exemplo: https://www.google.com.br/arquivo.pdf')
            ->columnSpanFull()
            ->suffixAction(
                Action::make('uploadExternalFile')
                    ->label('Upload Externo')
                    ->icon('heroicon-m-clipboard')
                    ->requiresConfirmation()
                    ->action(function (Set $set, $state) use ($file) {
                        $name = Str::afterLast($state, '/');
                        $ext = Str::afterLast($name, '.');
                        $name = Str::beforeLast($name, '.');
                        $name = Str::slug($name);
                        $name = sprintf("%s/%s", get_tenant_id(), $name, $ext);
                        $result =  static::downloadFileFromUrl($state, $name);
                        if ($result) {
                            $set($file, $result);
                        }
                    })
            )
            ->maxLength(255);
    }
}
