<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavBar extends Component
{
    public $mobileMenu = false;
    public function render()
    {
        return view('livewire.nav-bar');
    }
    public function showMobileMenu(){
        $this->mobileMenu = true;
    }
}

