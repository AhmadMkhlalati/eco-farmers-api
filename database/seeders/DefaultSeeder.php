<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::query()->create([
            'name' => 'user 1',
            'email' => 'admin@test.com',
            'password' => Hash::make('12345678')
        ]);
    }
}
