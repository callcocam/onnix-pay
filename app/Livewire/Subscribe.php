<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

use App\Models\Subscribe as ModelsSubscribe;
use Filament\Notifications\Notification;
use Livewire\Component;

class Subscribe extends Component
{

    public $email;

    public $messages = [
        'email.required' => 'O campo email é obrigatório.',
        'email.email' => 'O campo email deve ser um email válido.',
        'email.unique' => 'O email informado já está cadastrado.',
    ];

    public function sendSubscribe()
    {
        $this->validate([
            'email' => 'required|email|unique:subscribes,email',
        ]);

        ModelsSubscribe::create(['email' => $this->email]);

        Notification::make('success')
            ->title('Inscrição realizada com sucesso!')
            ->body('Agora você receberá todas as novidades de nosso site.')
            ->send();

        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.subscribe');
    }
}
