<?php

namespace App\Http\Livewire\ContactUs;

use App\Http\Livewire\LiveWire;
use App\Models\ContactUs;
use Livewire\Component;

class ContactUsForm extends LiveWire
{
    public function render()
    {
        return view('livewire.contact-us.contact-us-form');
    }
    public $name;
    public $email;
    public $phone;
    public $subject;
    public $message;
    public $leadId;

    public function mount($leadId)
    {
        $this->leadId = $leadId;
        $contactUs = ContactUs::find($this->leadId);
        if ($contactUs) {
            $this->name = $contactUs->name;
            $this->email = $contactUs->email;
            $this->phone = $contactUs->phone;
            $this->subject = $contactUs->subject;
            $this->message = $contactUs->message;
        }
    }
}
