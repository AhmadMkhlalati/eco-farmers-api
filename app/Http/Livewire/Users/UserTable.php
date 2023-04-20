<?php

namespace App\Http\Livewire\Users;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Spatie\Permission\Models\Role;

class UserTable extends DataTableComponent
{

    public array $bulkActions = [
        'exportSelected' => 'Export',
    ];
    public $searchTearm;
    public function columns(): array
    {
        return [
//            Column::make("Id", "id")
//                ->sortable()->searchable(),
            ImageColumn::make('Avatar')
                ->location(
                    fn($row) => $row->getMedia('avatar')->count() >=1 ?  $row->getFirstMediaUrl('avatar') : 'https://via.placeholder.com/1200/000000/FFFFFF/?text='.$row->name
                ) ->attributes(fn($row) => [
                    'class' => 'object-cover w-16 h-16  rounded-full border-2 border-gray-200',
                ]),
            Column::make("Name", "name")
                ->sortable()->searchable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make('Role')
                ->label(
                    fn($row, Column $column) => ucfirst($row->roles->first()->name) ??''
                )->sortable(
                    fn(Builder $query, string $direction) => $query->roles->orderBy('name')
                ),
//            Column::make('Actions')
//                ->label(
//                    fn($row, Column $column) => view('livewire.roles.roles_table_actions')->with(['row'=>$row])
//                )
//                ->unclickable(),
        ];
    }



    public function filters(): array
    {
        $roles = Role::where('name', '!=', 'customer')->pluck('name')->toArray();
        $array =[];
        $array['All'] = 'All';
        foreach ($roles as $role){
            $array[$role] = $role;
        }
        return [
            MultiSelectFilter::make('Name')
                ->options(
                    User::query()
                        ->orderBy('name')
                        ->whereHas('roles', function ($q){
                            $roles = Role::where('name', '!=', 'customer')->pluck('name')->toArray();
                            $q->whereIn('name',$roles);
                        })
                        ->get()
                        ->keyBy('id')
                        ->map(fn($tag) => $tag->name)
                        ->toArray()
                )->filter(function(Builder $builder, array $values) {
                  $builder->whereIn('id', $values);
                }),
            SelectFilter::make('role')
                ->options(
                  $array
                )->filter(function(Builder $builder, string  $value) {
                    if($value =='All'){

                    }
                    else {
                        $builder->role($value);
                    }

                })
            ];
    }

    public function bulkActions(): array
    {
        return [
            'export' => 'Export',
        ];
    }

    /**
     * @throws \Rappasoft\LaravelLivewireTables\Exceptions\DataTableConfigurationException
     */
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
            ->setSecondaryHeaderTrAttributes(function($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setSecondaryHeaderTdAttributes(function(Column $column, $rows) {
                if ($column->isField('id')) {
                    return ['class' => 'text-red-500'];
                }

                return ['default' => true];
            })
            ->setFooterTrAttributes(function($rows) {
                return ['class' => 'bg-gray-100'];
            })
            ->setFooterTdAttributes(function(Column $column, $rows) {
                if ($column->isField('name')) {
                    return ['class' => 'text-green-500'];
                }

                return ['default' => true];
            })
            ->setUseHeaderAsFooterEnabled()
        ;
    }

    public function builder(): Builder
    {
        $roles = Role::where('name', '!=','customer')->pluck('name')->toArray();
        return User::query()->role($roles)->select('*');
    }

}
