<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shipping::truncate();
        Shipping::create([
            'title' => 'Shipping Title',
            'description' => '<p>Shipping Description</p>',
        ]);
    }
}
