<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Category::insert([
            [
                'name' => 'Category 1',
                'status' => 'active',
            ],
            [
                'name' => 'Category 2',
                'status' => 'active',
            ],
            [
                'name' => 'Category 3',
                'status' => 'active',
            ],
            [
                'name' => 'Category 4',
                'status' => 'active',
            ],
            [
                'name' => 'Category 5',
                'status' => 'active',
            ]]
        );
    }
}
