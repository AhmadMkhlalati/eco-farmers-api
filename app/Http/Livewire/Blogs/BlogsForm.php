<?php

namespace App\Http\Livewire\Blogs;

use App\Http\Livewire\LiveWire;
use App\Models\Blog;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class BlogsForm  extends LiveWire
{
    use LivewireAlert, WithFileUploads;

    public $blogId;
    public $title;
    public $description;
    public $image;
    public $newImage;
    public $status;
    public $slug;
    public $summary;

    protected $listeners = ['blogAdded'];

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function mount()
    {
        $this->blogId = request()->blogId;
        $blog = Blog::query()->find($this->blogId);
        if ($blog) {
            $this->title = $blog->title;
            $this->description = $blog->description;
            $this->status = $blog->status == 'active';
            $this->slug = $blog->slug;
            $this->summary = $blog->summary;
            if (count($blog->getMedia('blogs')) > 0) {
                $this->image = $blog->getMedia('blogs')[0]->getFullUrl();
            }
        }
    }

    public function save()
    {

        $this->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'nullable|boolean',
            'slug' => 'required|unique:blogs,slug,' . $this->blogId,
            'summary' => 'required|min:10',

        ],
            [
                'title.required' => 'The Title is required',
                'description.required' => 'The Description is required',
                'slug.required' => 'The Slug is required',
                'slug.unique' => 'The Slug already exists',
                'summary.required' => 'The Summary is required',
                'summary.min' => 'The minimum characters is 10',
            ]
        );
        $blog = Blog::query()->updateOrCreate(
            ['id' => $this->blogId],
            [
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status ? 'active' : 'inactive',
                'slug' => $this->slug,
                'summary' => $this->summary,
            ]
        );
        if ($blog) {
            if ($this->blogId) {
                $message = 'The News was updated !';
                if (is_null($this->image)) {
                    if (count($blog->media) > 0) {
                        $blog->media[0]->delete();
                    }
                }
                if ($this->newImage) {
                    if (count($blog->media) > 0) {
                        $blog->media[0]->delete();
                    }
                    $blog->addMedia($this->newImage)
                        ->toMediaCollection('blogs');
                }
            } else {
                $message = 'The News was created !';
                if ($this->image) {
                    $blog->addMedia($this->image)
                        ->toMediaCollection('blogs');
                }
            }
            $this->alert('success', $message, [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            if ($this->blogId) {
                return redirect()->route('admin.blog');
            }
            $this->dispatchBrowserEvent('blogAdded');

            return $this->reset(['title', 'summary', 'slug', 'description', 'status', 'image', 'blogId']);

        }
        $this->alert('error', 'The News was not created please try again later', [
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
        return view('livewire.blogs.blogs-form');
    }
}
