<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Sidebar extends Component
{
    public $items;
    public $isSidenavOpen = true;
    public $language, $languages, $languageCode;
    public $selectedAccount;

    public function render()
    {
        return view('livewire.components.sidebar');
    }
}
