<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace Callcocam\Acl\Traits;

use Callcocam\Tenant\Traits\HasUploadFormField;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Leandrocfe\FilamentPtbrFormFields\Document;

trait HasUserFormSchema
{
    use HasUploadFormField, HasEditorColumn, HasPasswordCreateOrUpdate;
    
    public function userFormSchema($preppends = [], $appends = [], $excludes = [])
    {

        if (!in_array('type', $excludes)) {
            $preppends[] = Select::make('type')
                ->label(__('acl::acl.forms.user.type.label'))
                ->options(config('acl.resources.user.type.options', [
                    'user' => 'User',
                    'client' => 'Client',
                ]))
                ->columnSpan(config('acl.resources.user.type.columnSpan', [
                    'md' => 2,
                ]))
                ->required(config('acl.resources.user.type.required', true));
        }

        if (!in_array('name', $excludes)) {
            $preppends[] = TextInput::make('name')
                ->label(__('acl::acl.forms.user.name.label'))
                ->placeholder(__('acl::acl.forms.user.name.placeholder'))
                ->columnSpan(config('acl.forms.user.name.columnSpan', [
                    'md' => 6,
                ]))
                ->required(config('acl.forms.user.name.required', true))
                ->hidden(config('acl.forms.user.name.hidden', false))
                ->hiddenLabel(config('acl.forms.user.name.hiddenLabel', false))
                ->maxLength(config('acl.forms.user.name.maxLength', 255));
        }

        if (!in_array('email', $excludes)) {
            $preppends[] = TextInput::make('email')
                ->label(__('acl::acl.forms.user.email.label'))
                ->placeholder(__('acl::acl.forms.user.email.placeholder'))
                ->columnSpan(config('acl.forms.user.email.columnSpan', [
                    'md' => 4,
                ]))
                ->email()
                ->required(config('acl.forms.user.email.required', true))
                ->hidden(config('acl.forms.user.email.hidden', false))
                ->hiddenLabel(config('acl.forms.user.email.hiddenLabel', false))
                ->maxLength(config('acl.forms.user.email.maxLength', 255));
        }

        if (!in_array('cover', $excludes)) {
            $preppends[] = static::getUploadFormFieldset('cover');
        }

        if (!in_array('office', $excludes)) {
            $preppends[] = TextInput::make('office')
                ->label(__('acl::acl.forms.user.office.label'))
                ->placeholder(__('acl::acl.forms.user.office.placeholder'))
                ->columnSpan(config('acl.forms.user.office.columnSpan', [
                    'md' => 3,
                ]))
                ->required(config('acl.forms.user.office.required', false))
                ->hidden(config('acl.forms.user.office.hidden', false))
                ->hiddenLabel(config('acl.forms.user.office.hiddenLabel', false))
                ->maxLength(config('acl.forms.user.office.maxLength', 255));
        }

        if (!in_array('date_birth', $excludes)) {
            $preppends[] = DatePicker::make('date_birth')
                ->label(__('acl::acl.forms.user.date_birth.label'))
                ->placeholder(__('acl::acl.forms.user.date_birth.placeholder'))
                ->required(config('acl.forms.user.date_birth.required', false))
                ->hidden(config('acl.forms.user.date_birth.hidden', false))
                ->hiddenLabel(config('acl.forms.user.date_birth.hiddenLabel', false))
                ->columnSpan(config('acl.forms.user.date_birth.columnSpan', [
                    'md' => 2,
                ]));
        }

        if (!in_array('genre', $excludes)) {
            $preppends[] = Fieldset::make(__('acl::acl.forms.user.genre.fieldset'))
                ->schema([
                    Radio::make('genre')
                        ->hiddenLabel()
                        ->label(__('acl::acl.forms.user.genre.label'))
                        ->visible(config('acl.forms.user.genre.visible', true))
                        ->inline()
                        ->options(config('acl.forms.user.genre.options', [
                            'masculino' => 'Masculino',
                            'feminino' => 'Feminino',
                            'outros' => 'Outros',
                        ]))
                ])->columnSpan(config('acl.forms.user.genre.columnSpan', [
                    'md' => 7,
                ]));
        }


        if (!in_array('document', $excludes)) {
            $preppends[] = Document::make('document')
                ->dynamic()
                ->label(__('acl::acl.forms.user.document.label'))
                ->columnSpan(config('acl.forms.user.document.columnSpan', [
                    'md' => 3,
                ]))
                ->required(config('acl.forms.user.document.required', false))
                ->hidden(config('acl.forms.user.document.hidden', false))
                ->hiddenLabel(config('acl.forms.user.document.hiddenLabel', false));
        }

        if (!in_array('profession', $excludes)) {
            $preppends[] = TextInput::make('profession')
                ->label(__('acl::acl.forms.user.profession.label'))
                ->placeholder(__('acl::acl.forms.user.profession.placeholder'))
                ->columnSpan(config('acl.forms.user.profession.columnSpan', [
                    'md' => 9,
                ]))
                ->required(config('acl.forms.user.profession.required', false))
                ->hidden(config('acl.forms.user.profession.hidden', false))
                ->hiddenLabel(config('acl.forms.user.profession.hiddenLabel', false))
                ->maxLength(config('acl.forms.user.profession.maxLength', 255));
        }

        if (!in_array('vereador_old_id', $excludes)) {
            $preppends[] = TextInput::make('vereador_old_id')
                ->label(__('acl::acl.forms.user.vereador_old_id.label'))
                ->placeholder(__('acl::acl.forms.user.vereador_old_id.placeholder'))
                ->columnSpan(config('acl.forms.user.vereador_old_id.columnSpan', [
                    'md' => 3,
                ]))
                ->required(config('acl.forms.user.vereador_old_id.required', false))
                ->hidden(config('acl.forms.user.vereador_old_id.hidden', false))
                ->hiddenLabel(config('acl.forms.user.vereador_old_id.hiddenLabel', false))
                ->maxLength(config('acl.forms.user.vereador_old_id.maxLength', 255));
        }

        if (!in_array('formations', $excludes)) {
            $preppends[] = TextInput::make('formations')
                ->label(__('acl::acl.forms.user.formations.label'))
                ->placeholder(__('acl::acl.forms.user.formations.placeholder'))
                ->columnSpan(config('acl.forms.user.formations.columnSpan', [
                    'md' => 6,
                ]))
                ->required(config('acl.forms.user.formations.required', false))
                ->hidden(config('acl.forms.user.formations.hidden', false))
                ->hiddenLabel(config('acl.forms.user.formations.hiddenLabel', false))
                ->maxLength(config('acl.forms.user.formations.maxLength', 255));
        }

        if (!in_array('nationality', $excludes)) {
            $preppends[] =   TextInput::make('nationality')
                ->label(__('acl::acl.forms.user.nationality.label'))
                ->placeholder(__('acl::acl.forms.user.nationality.placeholder'))
                ->columnSpan(config('acl.forms.user.nationality.colunmSpan', [
                    'md' => 3,
                ]))
                ->required(config('acl.forms.user.nationality.required', false))
                ->hidden(config('acl.forms.user.nationality.hidden', false))
                ->hiddenLabel(config('acl.forms.user.nationality.hiddenLabel', false))
                ->maxLength(config('acl.forms.user.nationality.maxLength', 255));
        }

        if (!in_array('biography', $excludes)) {
            $preppends[] = RichEditor::make('biography')
                ->label(__('acl::acl.forms.user.biography.label'))
                ->placeholder(__('acl::acl.forms.user.biography.placeholder'))
                ->columnSpan(config('acl.forms.user.biography.columnSpan', [
                    'md' => 12,
                ]))
                ->required(config('acl.forms.user.biography.required', false))
                ->hidden(config('acl.forms.user.biography.hidden', false))
                ->hiddenLabel(config('acl.forms.user.biography.hiddenLabel', false));
        }

        if (!in_array('email_verified', $excludes)) {
            $preppends[] = Toggle::make('email_verified')
                ->visible(config('acl.forms.user.email_verified.visible', false))
                ->label(__('acl::acl.forms.user.email_verified.label'))
                ->helperText(__('acl::acl.forms.user.email_verified.helpText'))
                ->columnSpan(config('acl.forms.user.email_verified.columnSpan', [
                    'md' => 3,
                ]));
        }

        if (!in_array('status', $excludes)) {
            $preppends[] = Radio::make('status')
                ->visible(config('acl.forms.user.status.visible', true))
                ->options(config('acl.forms.user.status.options', [
                    'published' => 'Ativo',
                    'draft' => 'Inativo',
                ]))
                ->columnSpan(config('acl.forms.user.status.columnSpan', [
                    'md' => 12,
                ]))
                ->required(config('acl.forms.user.status.required', true));
        }

        if (!in_array('roles', $excludes)) {
            $preppends[] = Fieldset::make(__('acl::acl.forms.user.roles.label'))
                ->visible(function () {
                    if (auth()->user()->isAdmin()) return true;

                    $access = config('acl.forms.user.roles.visible',  'super-admin');
                    if (is_array($access)) {
                        return auth()->user()->hasAnyRoles($access);
                    }
                    return auth()->user()->hasAnyRole($access);
                })
                ->schema([
                    CheckboxList::make('roles')
                        ->relationship('roles', 'name')
                        ->bulkToggleable(config('acl.forms.user.roles.bulkToggleable', true))
                        ->searchable(config('acl.forms.user.roles.searchable', true))
                        ->label(config('acl.forms.user.roles.label', 'Roles'))
                        ->helperText(config('acl.forms.user.roles.helperText', 'Select roles for this user.'))
                        ->columnSpanFull(),
                ])->columnSpanFull();
        }

        if (!in_array('access', $excludes)) {
            $preppends[] = Fieldset::make(__('acl::acl.forms.user.data.access.label'))->schema([
                ...static::getFieldPasswordForUpdateForm()
            ])->columns(3);
        }

        if (!in_array('editor', $excludes)) {
            $preppends[] = static::getEditorFormField();
        }

        return array_merge($preppends, $appends);
    }
}
