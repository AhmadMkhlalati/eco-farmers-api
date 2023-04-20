<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class SyncOldCategoriesWithSlug extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Schema::hasColumn('categories','slug')){
            $categories = Category::query()->whereNull('slug')->get();

            foreach ($categories as $category) {
                $category->update([
                    'slug' => Str::slug($category->name)
                ]);
                $category->save();
            }
        }

    }
}
