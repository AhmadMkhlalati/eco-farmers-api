<?php

namespace App\Http\Livewire\ContactUs;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ContactUsDataTable extends DataTableComponent
{
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
            Column::make("Name", "name")->sortable()->searchable(),
            Column::make("Subject", "subject")->sortable()->searchable(),
            Column::make("Email", "email")->sortable()->searchable(),
            Column::make("Phone", "phone")->sortable()->searchable(),
            Column::make('Actions')
                ->label(
                    fn($row, Column $column) => view('livewire.global.actions-delete-show')->with(['row' => $row])
                )
                ->unclickable(),
        ];
    }
    public function builder(): Builder
    {
        return ContactUs::query()->select('*');
    }

    public function deleteCheck($leadId)
    {
        $this->leadId = $leadId;
        $this->alert('warning', 'Are you sure?', [
            'position' => 'center',
            'title' => 'Delete Lead',
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
        ContactUS::query()->find($this->leadId)->delete();
        $this->emit('refreshDatatable');

        $this->alert('success', 'The lead was deleted successfully!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function openShowPage($leadId)
    {
        return redirect()->route('admin.contact_us.form', ['leadId' => $leadId]);
    }

}
