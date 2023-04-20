<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class SidebarItem extends Component
{
    public $route, $icon, $title, $items = [];

    public $showDropdown = false;

    public function mount()
    {
        if (request()->route()->getName() == $this->route) {
            $this->showDropdown = true;
        }
        if (count($this->items)) {
            foreach ($this->items as $menuItem) {
                if (request()->route()->getName() == $menuItem['route']) {
                    $this->showDropdown = true;
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.components.sidebar-item');
    }
}
