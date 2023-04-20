<?php

namespace App\Http\Livewire\Services;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ServicesShow extends Component
{
    use LivewireAlert;

    public function render()
    {
        return view('livewire.services.services-show');
    }
}
