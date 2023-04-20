<?php

namespace App\Http\Livewire\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class ServicesDataTable extends DataTableComponent
{
    use LivewireAlert;

    public $requiredActions = ['delete', 'edit', 'show'];
    public $listeners = ['delete'];

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
                    fn($row) => $row->getMedia('services')->count() >= 1 ? $row->getFirstMediaUrl('services') : 'https://via.placeholder.com/1200/000000/FFFFFF/?text=' . $row->name
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
        return Service::query()->select('*');
    }
    public function deleteCheck($serviceId)
    {
        $this->serviceId = $serviceId;
        $this->alert('warning', 'Are you sure?', [
            'position' => 'center',
            'title' => 'Delete Service',
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
        Service::query()->find($this->serviceId)->delete();
        $this->emit('refreshDatatable');

        $this->alert('success', 'The Service was deleted successfully!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function openEditPage($serviceId)
    {
        return redirect()->route('admin.service.form', ['serviceId' => $serviceId]);
    }
    public function deactivate($serviceId)
    {
        Service::where('id', $serviceId)->update([
            'status' => 'inactive',
        ]);
    }
    public function activate($serviceId)
    {
        Service::where('id', $serviceId)->update([
            'status' => 'active',
        ]);
    }
}
