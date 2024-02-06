<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

// use Laravel\Cashier\Cashier;

use App\Models\Faq;
use Filament\Notifications\Notification;
use Livewire\Component;

class ContactComponent extends Component
{

    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $description;

    public $messages = [
        'email.required' => 'O campo email é obrigatório.',
        'email.email' => 'O campo email deve ser um email válido.',
        'email.unique' => 'O email informado já está cadastrado.',
        'phone.required' => 'O campo telefone é obrigatório.',
        'firstName.required' => 'O campo nome é obrigatório.',
        'lastName.required' => 'O campo sobrenome é obrigatório.',
        'description.required' => 'O campo mensagem é obrigatório.',
    ];

    public function mount()
    {
        // $user = auth()->user();
        //     if (!$user->stripe_id) {
        //         $stripeCustomer = $user->createAsStripeCustomer();
        //     }else{
        //         $stripeCustomer = $user->asStripeCustomer();
        //     } 
        //     $balance = $user->balance();
        //    dd($balance);
    }
    public function render()
    {
        return view('livewire.contact-component');
    }

    public function sendMessage()
    {
        $this->validate([
            'email' => 'required|email',
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'description' => 'required',
        ]);

        Faq::create([ 
            'email' => $this->email,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'phone' => $this->phone,
            'description' => $this->description,
            'status' => 'draft'
        ]);

        $this->reset('email', 'firstName', 'lastName', 'phone', 'description');

        Notification::make('success')
            ->title('Mensagem enviada com sucesso!')
            ->body('Em breve entraremos em contato.')
            ->send();
    }
}
