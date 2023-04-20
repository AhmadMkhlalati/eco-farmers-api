<?php

namespace App\Http\Livewire\Services;

use App\Http\Livewire\LiveWire;
use App\Models\Service;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ServicesForm extends LiveWire
{
    use LivewireAlert, WithFileUploads;

    public $serviceId;
    public $name;
    public $description;
    public $image;
    public $newImage;
    public $status;
    public $slug;
    public $summary;
    protected $listeners = ['serviceAdded'];

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function mount()
    {
        $this->serviceId = request()->serviceId;
        $service = Service::query()->find($this->serviceId);
        if ($service) {
            $this->name = $service->name;
            $this->description = $service->description;
            $this->status = $service->status == 'active';
            $this->slug = $service->slug;
            $this->summary = $service->summary;

            if (count($service->getMedia('services')) > 0) {
                $this->image = $service->getMedia('services')[0]->getFullUrl();
            }
        }
    }

    public function save()
    {

        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'nullable|boolean',
            'slug' => 'required|unique:services,slug,' . $this->serviceId,
            'summary' => 'required|min:10',

        ],
            [
                'name.required' => 'The Name is required',
                'description.required' => 'The Description is required',
                'slug.required' => 'The Slug is required',
                'slug.unique' => 'The Slug already exists',
                'summary.required' => 'The Summary is required',
                'summary.min' => 'The minimum characters is 10',
            ],
            callBackFunctionFails: fn() => $this->alert('error','Error The Validation Failed')
        );
        $service = Service::query()->updateOrCreate(
            ['id' => $this->serviceId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'status' => $this->status ? 'active' : 'inactive',
                'slug' => $this->slug,
                'summary' => $this->summary,

            ]
        );
        if ($service) {
            if ($this->serviceId) {
                $message = 'The Service was updated !';
                if (is_null($this->image)) {
                    if (count($service->media) > 0) {
                        $service->media[0]->delete();
                    }
                }
                if ($this->newImage) {
                    if (count($service->media) > 0) {
                        $service->media[0]->delete();
                    }
                    $service->addMedia($this->newImage)
                        ->toMediaCollection('services');
                }
            } else {
                $message = 'The Service was created !';
                if ($this->image) {
                    $service->addMedia($this->image)
                        ->toMediaCollection('services');
                }
            }
            $this->alert('success', $message, [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            if ($this->serviceId) {
                return redirect()->route('admin.service');
            }
            $this->dispatchBrowserEvent('serviceAdded');

            return $this->reset(['name', 'summary', 'slug', 'description', 'status', 'image', 'serviceId']);

        }
        $this->alert('error', 'The Service was not created please try again later', [
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
        return view('livewire.services.services-form');
    }
}
