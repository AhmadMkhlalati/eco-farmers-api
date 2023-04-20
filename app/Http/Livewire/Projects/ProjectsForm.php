<?php

namespace App\Http\Livewire\Projects;

use App\Http\Livewire\LiveWire;
use App\Models\Project;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProjectsForm extends LiveWire
{
    use LivewireAlert;
    use WithFileUploads;

    public $projectId;
    public $name;
    public $description;
    public $image;
    public $newImage;
    public $status;
    public $slug;
    public $summary;

    protected $listeners = ['projectAdded'];
    public function updatedName()
    {
        $this->slug = Str::slug($this->name);
    }

    public function mount()
    {
        $this->projectId = request()->projectId;
        $project = Project::query()->find($this->projectId);
        if ($project) {
            $this->name = $project->name;
            $this->description = $project->description;
            $this->status = $project->status == 'active';
            $this->slug = $project->slug;
            $this->summary = $project->summary;

            if (count($project->getMedia('projects')) > 0) {
                $this->image = $project->getMedia('projects')[0]->getFullUrl();
            }
        }
    }

    public function save()
    {

        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'nullable|boolean',
            'summary' => 'required|min:10',
            'slug' => 'required|unique:projects,slug,' . $this->projectId,
        ],
            [
                'name.required' => 'The name field is required',
                'description.required' => 'The description filed is required',
                'status.boolean' => 'The status must be a boolean',
                'slug.required' => 'The Slug is required',
                'slug.unique' => 'The Slug already exists',
                'summary.required' => 'The Summary is required',
                'summary.min' => 'The minimum characters is 10',
            ]
        );
        $project = Project::query()->updateOrCreate(
            ['id' => $this->projectId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'status' => $this->status ? 'active' : 'inactive',
                'slug' => $this->slug,
                'summary' => $this->summary,

            ]
        );
        if ($project) {
            if ($this->projectId) {
                $message = 'The Project was updated !';
                if (is_null($this->image)) {
                    if (count($project->media) > 0) {
                        $project->media[0]->delete();
                    }
                }
                if ($this->newImage) {
                    if (count($project->media) > 0) {
                        $project->media[0]->delete();
                    }
                    $project->addMedia($this->newImage)
                        ->toMediaCollection('projects');
                }
            } else {
                $message = 'The Project was created !';
                if ($this->image) {
                    $project->addMedia($this->image)
                        ->toMediaCollection('projects');
                }
            }
            $this->alert('success', $message, [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
            if ($this->projectId) {
                return redirect()->route('admin.projects');
            }
            $this->dispatchBrowserEvent('projectAdded');
            return $this->reset(['name', 'summary', 'slug', 'description', 'status', 'image', 'projectId']);

        }
        $this->alert('error', 'The Project was not created please try again later', [
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
        return view('livewire.projects.projects-form');
    }
}
