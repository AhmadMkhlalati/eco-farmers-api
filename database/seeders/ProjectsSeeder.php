<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();

        $project1 = Project::query()->create(
            [
                'name' => 'project 1',
                'summary' => 'Summary for project',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => 'active',
                'slug' => 'project-1',
                'created_at' => now(),
            ]);
        $project2 = Project::query()->create(
            [
                'name' => 'project 2',
                'summary' => 'Summary for project',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 2500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => 'active',
                'slug' => 'project-2',
                'created_at' => now(),
            ]);
        $project3 = Project::query()->create(
            [
                'name' => 'project 3',
                'summary' => 'Summary for project',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 3500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => 'active',
                'slug' => 'project-3',
                'created_at' => now(),
            ]);
        $project4 = Project::query()->create(
            [
                'name' => 'project 4',
                'summary' => 'Summary for project',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 4500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => 'active',
                'slug' => 'project-4',
                'created_at' => now(),
            ]);
        $project5 = Project::query()->create(
            [
                'name' => 'project 5',
                'summary' => 'Summary for project',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 5500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',
                'status' => 'active',
                'slug' => 'project-5',
                'created_at' => now(),
            ]);
        $project1->addMedia(public_path('images/projects/1.png'))->preservingOriginal()->toMediaCollection('projects');
        $project2->addMedia(public_path('images/projects/2.png'))->preservingOriginal()->toMediaCollection('projects');
        $project3->addMedia(public_path('images/projects/3.png'))->preservingOriginal()->toMediaCollection('projects');
        $project4->addMedia(public_path('images/projects/4.png'))->preservingOriginal()->toMediaCollection('projects');
        $project5->addMedia(public_path('images/projects/5.png'))->preservingOriginal()->toMediaCollection('projects');

    }
}
