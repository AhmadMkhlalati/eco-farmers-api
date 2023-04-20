<?php

namespace App\Http\Livewire\Projects;

use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class ProjectsDatatable extends DataTableComponent
{
    public $requiredActions = ['delete', 'edit', 'show'];
    public $confirmingProjectDeletion = [];
    public $modelId, $projects;
    public $project;

    public $listeners = ['delete'];

    use LivewireAlert;
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setFooterStatus(true)
            ->setSortingStatus(true)
            ->setSortingPillsStatus(true)
            ->setFilterLayout('popover')
            ->setSingleSortingDisabled()
            ->setHideReorderColumnUnlessReorderingEnabled()
            ->setRememberColumnSelectionDisabled()
            ->setSecondaryHeaderTrAttributes(function ($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setSecondaryHeaderTdAttributes(function (Column $column, $rows) {
                if ($column->isField('id')) {
                    return ['class' => 'text-red-500'];
                }
                return ['default' => true];
            })
            ->setFooterTrAttributes(function ($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setFooterTdAttributes(function (Column $column, $rows) {
                if ($column->isField('name')) {
                    return ['class' => 'text-green-500'];
                }
                return ['default' => true];
            })
            ->setUseHeaderAsFooterEnabled();
    }
    public function columns(): array
    {
        return [
            Column::make("ID", "id")->sortable()->searchable(),

            ImageColumn::make('Image')
                ->location(
                    fn($row) => $row->getMedia('projects')->count() >= 1 ? $row->getFirstMediaUrl('projects') : 'https://via.placeholder.com/1200/000000/FFFFFF/?text=' . $row->name
                )->attributes(fn($row) => [
                'class' => 'object-cover w-16 h-16  rounded-full border-2 border-gray-200',
            ]),

            Column::make("Name", "name")->sortable()->searchable(),
            Column::make("Slug", "slug")->sortable()->searchable(),

            BooleanColumn::make("Status", "status")->sortable()->setCallback(function (string $value, $row) {
                if ($value == 'active') {
                    return true;
                } else {
                    return false;
                }
            }),

            Column::make('Actions')
                ->label(
                    fn($row, Column $column) => view('livewire.global.actions-data-table')->with(['row' => $row, 'requiredActions' => $this->requiredActions])
                )
                ->unclickable(),
        ];
    }
    public function builder(): Builder
    {
        return Project::query()->select('*');
    }

    public function deleteCheck($projectId)
    {
        $this->projectId = $projectId;
        $this->alert('warning', 'Are you sure?', [
            'position' => 'center',
            'title' => 'Delete Project',
            'showConfirmButton' => true,
            'showCancelButton' => true,
            'onConfirmed' => 'delete',
            'onDismissed' => '',
            'cancelButtonText' => 'Cancel ',
            'confirmButtonText' => 'Delete',
        ]);
    }

    public function delete()
    {
        Project::query()->find($this->projectId)->delete();
        $this->emit('refreshDatatable');

        $this->alert('success', 'The project was deleted successfully!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function openEditPage($projectId)
    {
        return redirect()->route('admin.project.form', ['projectId' => $projectId]);
    }

    public function deactivate($id)
    {
        Project::where('id', $id)->update([
            'status' => 'inactive',
        ]);
    }
    public function activate($id)
    {
        Project::where('id', $id)->update([
            'status' => 'active',
        ]);
    }

}
