<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class BlogsDataTable extends DataTableComponent
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
                    fn($row) => $row->getMedia('blogs')->count() >= 1 ? $row->getFirstMediaUrl('blogs') : 'https://via.placeholder.com/1200/000000/FFFFFF/?text=' . $row->name
                )->attributes(fn($row) => [
                'class' => 'object-cover w-16 h-16  rounded-full border-2 border-gray-200',
            ]),
            Column::make("Title", "Title")->sortable()->searchable(),
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
        return Blog::query()->select('*');
    }
    public function deleteCheck($blogId)
    {
        $this->blogId = $blogId;
        $this->alert('warning', 'Are you sure?', [
            'position' => 'center',
            'title' => 'Delete Blog',
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
        Blog::query()->find($this->blogId)->delete();
        $this->emit('refreshDatatable');

        $this->alert('success', 'The News was deleted successfully!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
        ]);
    }

    public function openEditPage($blogId)
    {
        return redirect()->route('admin.blog.form', ['blogId' => $blogId]);
    }
    public function deactivate($blogId)
    {
        Blog::where('id', $blogId)->update([
            'status' => 'inactive',
        ]);
    }
    public function activate($blogId)
    {
        Blog::where('id', $blogId)->update([
            'status' => 'active',
        ]);
    }
}
