<?php

namespace App\Http\Livewire\Category;

use App\Http\Livewire\LiveWire;
use App\Models\Category;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CategoryForm extends LiveWire
{
    use LivewireAlert, WithFileUploads;

    public $categoryId;
    public $name;
    public $status;
    public $image;
    public $newImage;
    public $slug;

    public function mount()
    {
        $this->categoryId = request()->categoryId;
        $category = Category::query()->find($this->categoryId);
        if ($category) {
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->status = $category->status == 'active';
            if (count($category->getMedia('categories')) > 0) {
                $this->image = $category->getMedia('categories')[0]->getFullUrl();
            }
        }
    }

    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function removeImage()
    {
        $this->reset('image');
    }

    public function removeImageForUpdate()
    {
        $this->reset('newImage');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:categories,name,' . $this->categoryId,
            'status' => 'nullable|boolean',
        ],
            [
                'name.required' => 'The Name field is required',
                'name.unique' => 'The Category already exists!',
                'status.boolean' => 'The status must be a boolean',
                'image.required' => 'The Image is required',

            ]
        );
        $category = Category::query()->updateOrCreate(
            ['id' => $this->categoryId],
            [
                'name' => $this->name,
                'slug' => $this->slug,
                'status' => $this->status ? 'active' : 'inactive',

            ]
        );
        if ($category) {
            if ($this->categoryId) {
                $message = 'The Category was updated !';
                if (is_null($this->image)) {
                    if (count($category->media) > 0) {
                        $category->media[0]->delete();
                    }
                }
                if ($this->newImage) {
                    if (count($category->media) > 0) {
                        $category->media[0]->delete();
                    }
                    $category->addMedia($this->newImage)
                        ->toMediaCollection('categories');
                }
            } else {
                $message = 'The Category was created !';
                if ($this->image) {
                    $category->addMedia($this->image)
                        ->toMediaCollection('categories');
                }
            }
            $this->alert('success', $message, [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            if ($this->categoryId) {
                return redirect()->route('admin.category');
            }
            return $this->reset(['name', 'status', 'image', 'categoryId','slug']);
        }

    }

    public function render()
    {
        return view('livewire.category.category-form');
    }
}
