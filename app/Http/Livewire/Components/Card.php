<?php

namespace App\Http\Livewire\Components;

use App\Enums\CardType;
use App\Models\Task;
use App\Services\Dashboard\PercentageService;
use Livewire\Component;

class Card extends Component
{
    public $tasks;

    public function mount() {
        $this->tasks = Task::all();
    }

    public function render()
    {
        return view('livewire.components.card');
    }
}
