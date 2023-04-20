<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ShowProjects extends Component
{
    use LivewireAlert;

    public function delete()
    {
        Project::query()->find($this->projectId)->delete();
        $this->emit('refreshDatatable');
    }

    public function activate($projectId){
        Project::query()->find($projectId)->update([
            'status' => 'active',
        ]);
        $this->emit('refreshDatatable');
    }

    public function deactivate($projectId)
    {
        Project::query()->find($projectId)->update([
            'status' => 'inactive',
        ]);
        $this->emit('refreshDatatable');

    }
    public function render()
    {
        return view('livewire.projects.show-projects');
    }

}
