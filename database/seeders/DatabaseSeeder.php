<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Episode;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create()->each(function ($user) {
            $courses = Course::factory()->count(rand(1, 3))->create(['instructor_id' => $user->id]);

            $courses->each(function ($course) {
                // For each course, create 5 episodes
                Episode::factory()->count(rand(1, 10))->create(['course_id' => $course->id]);
            });
        });

    }
}
