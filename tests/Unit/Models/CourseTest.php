<?php

it('it belongs to an instructor', function () {
    $course = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->create();

    expect($course->instructor)
        ->toBeInstanceOf(App\Models\User::class)
        ->is_instructor->toBeTrue();
});

it('has many episodes', function () {
    $course = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->count(10), 'episodes')
        ->create();

    expect($course->episodes)
        ->toBeInstanceOf(Illuminate\Database\Eloquent\Collection::class)
        ->toHaveCount(10)
        ->each->toBeInstanceOf(App\Models\Episode::class);
});

it('has the episodes count', function () {
    $course = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->count(10), 'episodes')
        ->create();

    $course->loadCount('episodes');

    expect($course->episodes_count)->toBe(10);
});

it('has the total duration of all episodes', function () {
    $courseA = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->state(['duration' => 150]), 'episodes')
        ->create();

    $courseB = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->state(['duration' => 61]), 'episodes')
        ->create();

    $courseC = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->state(['duration' => 60]), 'episodes')
        ->create();

    $courseD = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->state(['duration' => 15]), 'episodes')
        ->create();

    $courseE = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->state(['duration' => 1]), 'episodes')
        ->create();

    $courseF = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->create();

    expect($courseA->formatted_duration)->toBe('2 hrs 30 mins');
    expect($courseB->formatted_duration)->toBe('1 hr 1 min');
    expect($courseC->formatted_duration)->toBe('1 hr');
    expect($courseD->formatted_duration)->toBe('15 mins');
    expect($courseE->formatted_duration)->toBe('1 min');
    expect($courseF->formatted_duration)->toBe('0 min');
});
