<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Tenant\Traits;

use Filament\Forms;
use Leandrocfe\FilamentPtbrFormFields\PhoneNumber;

trait HasTenantSchemaForm
{
    use HasUploadFormField;

    public function getTenantSchemaFrom($prepends = [], $appends = [], $excludes = [])
    {

        $contents = [
            Forms\Components\TextInput::make('name')
                ->label(__('tenant::tenant.forms.name.label'))
                ->placeholder(__('tenant::tenant.forms.name.placeholder'))
                ->columnSpan([
                    'md' => config('tenant.tenant.name.span', 5),
                ])
                ->required(config('tenant.tenant.name.required', false))
                ->maxLength(config('tenant.tenant.name.maxLength', 255)),
            Forms\Components\TextInput::make('email')
                ->label(__('tenant::tenant.forms.email.label'))
                ->placeholder(__('tenant::tenant.forms.email.placeholder'))
                ->columnSpan([
                    'md' => config('tenant.tenant.email.span', 4),
                ])
                ->required(config('tenant.tenant.email.required', false))
                ->maxLength(config('tenant.tenant.email.maxLength', 255)),
            Forms\Components\TextInput::make('domain')
                ->label(__('tenant::tenant.forms.domain.label'))
                ->placeholder(__('tenant::tenant.forms.domain.placeholder'))
                ->columnSpan([
                    'md' => config('tenant.tenant.domain.span', 3),
                ])
                ->readOnly(config('tenant.tenant.domain.readOnly', true))
                ->required(config('tenant.tenant.domain.required', false))
                ->maxLength(config('tenant.tenant.domain.maxLength', 255)),
            static::getUploadFormFieldset('cover'),
            Forms\Components\TextInput::make('sub_title')
                ->label(__('tenant::tenant.forms.sub_title.label'))
                ->placeholder(__('tenant::tenant.forms.sub_title.placeholder'))
                ->columnSpan([
                    'md' => config('tenant.tenant.sub_title.span', 12),
                ])
                ->required(config('tenant.tenant.sub_title.required', false))
                ->maxLength(config('tenant.tenant.sub_title.maxLength', 255)),
            Forms\Components\Textarea::make('preview')
                ->label(__('tenant::tenant.forms.preview.label'))
                ->placeholder(__('tenant::tenant.forms.preview.placeholder'))
                ->columnSpan([
                    'md' => config('tenant.tenant.preview.span', 12),
                ])
                ->readOnly(config('tenant.tenant.preview.readOnly', false))
                ->required(config('tenant.tenant.preview.required', false)), 

        ];

        $contents = array_merge($prepends, $contents, $appends);

        return $contents;
    }
}
