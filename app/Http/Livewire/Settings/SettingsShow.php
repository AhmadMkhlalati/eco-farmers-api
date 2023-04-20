<?php

namespace App\Http\Livewire\Settings;

use App\Models\Setting;
use App\Models\SocailMedia;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class SettingsShow extends Component
{
    use LivewireAlert;

    public $linkedIn;
    public $whatsapp;
    public $facebook;
    public $instagram;
    public $email;
    public $phoneNumber;
    public $twitter;
    public $youtube;
    public $tiktok;


    public function mount()
    {
        $socialMedia = SocailMedia::query()->first();
        $this->linkedIn = $socialMedia->linkedin;
        $this->whatsapp = $socialMedia->whatsapp;
        $this->facebook = $socialMedia->facebook;
        $this->instagram = $socialMedia->instagram;
        $this->email = $socialMedia->email;
        $this->phoneNumber = $socialMedia->phone_number;
        $this->twitter = $socialMedia->twitter;
        $this->youtube = $socialMedia->youtube;
        $this->tiktok = $socialMedia->tiktok;

    }

    public function save()
    {
        SocailMedia::query()->first()->update([
            'linkedIn' => $this->linkedIn,
            'whatsapp' => $this->whatsapp,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'tiktok' => $this->tiktok,
        ]);

        $this->alert('success', 'The Links where updated !', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);

    }

    public function render()
    {
        return view('livewire.settings.settings-show');
    }
}
