<?php

namespace App\Http\Livewire\Shipping;

use App\Models\Shipping;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ShippingShow extends Component
{
    use LivewireAlert, WithFileUploads;

    public $title;
    public $description;
    public $image;
    public $newImage;
    public $shippingId;

    protected $listeners = ['shippingAdded'];

    public function mount()
    {
        $shipping = Shipping::query()->first();
        if ($shipping) {
            $this->shippingId = $shipping->id;
            $this->title = $shipping->title;
            $this->description = $shipping->description;
            if (count($shipping->getMedia('shipping')) > 0) {
                $this->image = $shipping->getMedia('shipping')[0]->getFullUrl();
            }
        }

    }

    public function save()
    {
        $shipping = Shipping::query()->updateOrCreate(
            ['id' => $this->shippingId],
            [
                'title' => $this->title,
                'description' => $this->description,
            ]
        );
        if ($shipping) {
            if ($this->shippingId) {
                $message = 'The shipping was updated !';
                if (is_null($this->image)) {
                    if (count($shipping->media) > 0) {
                        $shipping->media[0]->delete();
                    }
                }
                if ($this->newImage) {
                    if (count($shipping->media) > 0) {
                        $shipping->media[0]->delete();
                    }
                    $shipping->addMedia($this->newImage)
                        ->toMediaCollection('shipping');
                }
            } else {
                $message = 'The shipping was created !';
                if ($this->image) {
                    $shipping->addMedia($this->image)
                        ->toMediaCollection('shipping');
                }
            }
            $this->alert('success', $message, [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            if ($this->shippingId) {
                return redirect()->route('admin.shipping');
            }
        }
        $this->alert('success', 'The Shipping Details where updated !', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);

    }
    public function removeImage()
    {
        $this->reset('image');
    }

    public function removeImageForUpdate()
    {
        $this->reset('newImage');
    }
    public function render()
    {
        return view('livewire.shipping.shipping-show');
    }
}
