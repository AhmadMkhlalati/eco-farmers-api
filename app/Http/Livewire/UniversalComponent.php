<?php

namespace App\Http\Livewire;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UniversalComponent extends Component
{
    use LivewireAlert;
    protected $listeners = ['testNotification', 'getNotifications', 'userCreated'];

    public function userCreated($message){
        $this->alert('success', $message);
        $count =auth()->user()->notifications->where('read_at', null)->count();
        $notifications = json_encode(auth()->user()->notifications->where('read_at', null), true);
        $this->dispatchBrowserEvent('getNotifications', ['count' => $count, 'notifications' => $notifications]);
    }

    public function rfqCreated($message){
        $this->alert('success', $message);
        $count =auth()->user()->notifications->where('read_at', null)->count();
        $notifications = json_encode(auth()->user()->notifications->where('read_at', null), true);
        $this->dispatchBrowserEvent('getNotifications', ['count' => $count, 'notifications' => $notifications]);
    }

    public function render()
    {
        return view('livewire.universal-component');
    }
}
