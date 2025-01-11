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
