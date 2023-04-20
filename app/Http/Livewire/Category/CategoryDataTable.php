<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class CategoryDataTable extends DataTableComponent
{
    use LivewireAlert;

    public $requiredActions = ['delete', 'edit', 'show'];
    public $listeners = ['delete'];
    public function configure(): void
    {
        $this->setPrimaryKey('id');

    }
    public function columns(): array
    {
        return [
            Column::make("ID", "id")->sortable()->searchable(),
            ImageColumn::make('Image')
                ->location(
                    fn($row) => $row->getMedia('categories')->count() >= 1 ? $row->getFirstMediaUrl('categories') : 'https://via.placeholder.com/1200/000000/FFFFFF/?text=' . $row->name
                )->attributes(fn($row) => [
                'class' => 'object-cover w-16 h-16  rounded-full border-2 border-gray-200',
            ]),

            Column::make("Name", "name")->sortable()->searchable(),
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
        return Category::query()->select('*');

    }
    public function deleteCheck($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->alert('warning', 'Are you sure?', [
            'position' => 'center',
            'title' => 'Delete Category',
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
        $category = category::query()->find($this->categoryId);
        if ($category->products()->exists()) {
            return $this->alert('error', 'The Category is used for products!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
        $category->delete();
        $this->emit('refreshDatatable');

        $this->alert('success', 'The Category was deleted successfully!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function openEditPage($categoryId)
    {
        return redirect()->route('admin.category.form', ['categoryId' => $categoryId]);
    }
    public function deactivate($categoryId)
    {
        Category::where('id', $categoryId)->update([
            'status' => 'inactive',
        ]);
    }
    public function activate($categoryId)
    {
        Category::where('id', $categoryId)->update([
            'status' => 'active',
        ]);
    }
}
