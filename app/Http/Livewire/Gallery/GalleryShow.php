<?php

namespace App\Http\Livewire\Gallery;

use App\Models\Gallery;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class GalleryShow extends Component
{
    use LivewireAlert, WithFileUploads;

    public $multiImages ;
    public $newMultiImages ;
    public $previouslyAddedNewImages ;
    public $galleryId;
    public $key;
    public $listeners = ['delete'];

    public function mount()
    {
        $this->multiImages = Gallery::all()->load('media')->pluck('media')->pluck(0);
    }

    public function updatedNewMultiImages()
    {
        $count = Gallery::query()->whereHas('media',function ($query){
            $query->where('collection_name','gallery');
        })->count();
        if($count >= 40){
            $this->alert('error', 'max allowed number of pictures is 40', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            return;
        }
        foreach ($this->newMultiImages as $key => $newMultiImage) {
            $media = new Gallery();
            $media->addMedia($newMultiImage)->toMediaCollection('gallery');
            $media->save();
        }
        $this->multiImages = Gallery::all()->load('media')->pluck('media')->pluck(0);

//        $this->previouslyAddedNewImages = array_merge($this->previouslyAddedNewImages, $this->newMultiImages);
//        $this->newMultiImages = $this->previouslyAddedNewImages;
        // here you can store immediately on any change of the property
    }

    public function removeFromMultiImage($key, $id)
    {
        $this->key = $key;
        $this->galleryId = $id;

        $this->alert('warning', 'Are you sure?', [
            'position' => 'center',
            'title' => 'Delete Gallery Image',
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'onConfirmed' => 'delete',
            'onDismissed' => '',
            'cancelButtonText' => 'Cancel ',
            'confirmButtonText' => 'Delete',
        ]);
    }

    public function delete(){
        $media = Media::query()->find($this->galleryId);
        $media?->model?->delete();
        if($media?->delete()){
            unset($this->multiImages[$this->key]);
        }
    }


    public function render()
    {
        return view('livewire.gallery.gallery-show');
    }


}
