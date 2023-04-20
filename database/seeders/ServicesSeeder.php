<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::truncate();
        $service1 = Service::query()->create(
            [
                'name' => 'Service 1',
                'summary' => 'Summary for service',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
                'status' => 'active',
                'slug' => 'service-1',
            ]);
        $service2 = Service::query()->create(
            [
                'name' => 'Service 2',
                'summary' => 'Summary for service',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
                'status' => 'active',
                'slug' => 'service-2',
            ]);
        $service3 = Service::query()->create(
            [
                'name' => 'Service 3',
                'summary' => 'Summary for service',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
                'status' => 'active',
                'slug' => 'service-3',
            ]);
        $service4 = Service::query()->create(
            [
                'name' => 'Service 4',
                'summary' => 'Summary for service',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
                'status' => 'active',
                'slug' => 'service-4',
            ]);
        $service5 = Service::query()->create(
            [
                'name' => 'Service 5',
                'summary' => 'Summary for service',
                'description' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ',
                'status' => 'active',
                'slug' => 'service-5',
            ]);
        $service1->addMedia(public_path('images/services/1.png'))->preservingOriginal()->toMediaCollection('services');
        $service2->addMedia(public_path('images/services/2.png'))->preservingOriginal()->toMediaCollection('services');
        $service3->addMedia(public_path('images/services/3.png'))->preservingOriginal()->toMediaCollection('services');
        $service4->addMedia(public_path('images/services/4.png'))->preservingOriginal()->toMediaCollection('services');
        $service5->addMedia(public_path('images/services/5.png'))->preservingOriginal()->toMediaCollection('services');

    }
}
