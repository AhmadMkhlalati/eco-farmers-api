<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DefaultSeeder::class,
            BlogsSeeder::class,
            ProjectsSeeder::class,
            ServicesSeeder::class,
            SocailMedialDefaultSeeder::class,
            ShippingSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
