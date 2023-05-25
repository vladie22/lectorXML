<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class LoginRegister extends Component
{
    use LivewireAlert;
    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];

    public function render()
    {
        return view('livewire.login-register');
    }

    public function getDataSignIn()
    {
        $this->validate();
        if(Auth::attempt(['email' => $this->email, 'password' => $this->password])){
            return redirect(route('readXmlData'));
        }else{
            $this->alert('error','El correo o contraseña son incorrectos');
        }
    }

    //  $validatedDate = $this->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);
    //     dd($this->password);
    //     if (Auth::attempt(array('email' => $this->email, 'password' => $this->password))) {
    //         $this->alert('success', "Has iniciado sesion");
    //     } else {
    //         $this->alert('error', 'error perro');
    //     }
}
