<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class ProductDataTable extends DataTableComponent
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
                    fn($row) => $row->getMedia('products')->count() >= 1 ? $row->getFirstMediaUrl('products') : 'https://via.placeholder.com/1200/000000/FFFFFF/?text=' . $row->name
                )->attributes(fn($row) => [
                'class' => 'object-cover w-16 h-16  rounded-full border-2 border-gray-200',
            ]),

            Column::make("Name", "name")->sortable()->searchable(),
            Column::make("Price", "price")->sortable()->searchable(),

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
        return Product::query()->select('*');
    }
    public function deleteCheck($productId)
    {
        $this->productId = $productId;
        $this->alert('warning', 'Are you sure?', [
            'position' => 'center',
            'title' => 'Delete Product',
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
        DB::beginTransaction();
        try {
            $product = Product::query()->find($this->productId);
            $product->media->delete();
            ProductCategory::query()->where('product_id', $this->productId)->delete();
            $product->delete();
            DB::commit();

            $this->emit('refreshDatatable');

            $this->alert('success', 'The Product was deleted successfully!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        } catch (\Exception$e) {
            DB::rollback();
            $this->alert('error', 'Cannot delete product!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function openEditPage($productId)
    {
        return redirect()->route('admin.product.form', ['productId' => $productId]);
    }
    public function deactivate($productId)
    {
        Product::where('id', $productId)->update([
            'status' => 'inactive',
        ]);
    }
    public function activate($productId)
    {
        Product::where('id', $productId)->update([
            'status' => 'active',
        ]);
    }

}
