<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();
        Product::insert([
            [
                'name' => 'Product 1',
                'slug' => 'product-1',
                'summary' => 'product 1 summary',
                'description' => '<p>Product 1 Description</p>',
                'price' => 1000,
                'status' => 'active',

            ],
            [
                'name' => 'Product 2',
                'slug' => 'product-2',
                'summary' => 'product 2 summary',
                'description' => '<p>Product 2 Description</p>',
                'price' => 2000,
                'status' => 'active',

            ],
            [
                'name' => 'Product 3',
                'slug' => 'product-3',
                'summary' => 'product 3 summary',
                'description' => '<p>Product 3 Description</p>',
                'price' => 3000,
                'status' => 'active',

            ],
            [
                'name' => 'Product 4',
                'slug' => 'product-4',
                'summary' => 'product 4 summary',
                'description' => '<p>Product 4 Description</p>',
                'price' => 4000,
                'status' => 'active',

            ]]
        );

        ProductCategory::truncate();
        ProductCategory::insert([
            [
                'product_id' => 1,
                'category_id' => 1,
            ],
            [
                'product_id' => 1,
                'category_id' => 2,
            ]]
        );
        ProductCategory::insert([
            [
                'product_id' => 2,
                'category_id' => 1,
            ],
            [
                'product_id' => 2,
                'category_id' => 2,
            ],
            [
                'product_id' => 2,
                'category_id' => 3,
            ]]
        );
        ProductCategory::insert([
            [
                'product_id' => 3,
                'category_id' => 1,
            ],
            [
                'product_id' => 3,
                'category_id' => 2,
            ],
            [
                'product_id' => 3,
                'category_id' => 3,
            ],
            [
                'product_id' => 3,
                'category_id' => 4,
            ],
            [
                'product_id' => 3,
                'category_id' => 5,
            ]]
        );
        ProductCategory::insert([
            [
                'product_id' => 4,
                'category_id' => 1,
            ]]);

    }
}
