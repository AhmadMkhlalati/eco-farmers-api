<?php

namespace App\Http\Livewire\Users;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Notifications\RealTimeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Query\Builder;
use function view;

class Users extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public  $modalFormVisible = false;
    public $name, $password, $email, $roles, $confirm_password,  $role, $photo;

    protected $listeners = [];

    public function mount(){
        $this->roles = Role::all()->pluck('name')->toArray();

    }

    public function createUserModal(){
        $this->modalFormVisible = true;
    }

    public function stopModalFormVisible(){
        $this->modalFormVisible = false;
    }

    public function createUser(){
        $admins = User::whereHas('roles', function ($q){
            $q->where('name', 'admin');
        })->where('id', '!=', auth()->user()->id)->get();
        $this->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' =>  Hash::make($this->password),

        ]);

        $user->addMedia($this->photo)
            ->usingName($user->id.'.png')
            ->toMediaCollection('avatar');
        $user->assignRole($this->role);
        $user->setStatus('active');
        $this->modalFormVisible = false;

        $this->emit('refreshDatatable');
        $this->alert('success', __('User created'), [
            'position' => 'top',
            'timer' => 3000,
            'toast' => true,
        ]);
        Notification::send($admins, new RealTimeNotification('New User Is Created ',auth()->user()));

    }
    public function render()
    {
        return view('livewire.users.users');
    }
}
