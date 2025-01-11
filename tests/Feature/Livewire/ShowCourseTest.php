<?php

use App\Livewire\ShowCourse;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ShowCourse::class)
        ->assertOk();
});

it('show course details', function() {
    // arrange
    $course = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->count(10), 'episodes')
        ->create();

    // act & assert
    Livewire::test(ShowCourse::class, ['course' => $course])
        ->assertOk()
        ->assertSeeText($course->title)
        ->assertSeeText($course->tagline)
        ->assertSeeText($course->description)
        ->assertSeeText($course->instructor->name)
        ->assertSeeText($course->created_at->diffForHumans())
        ->assertSeeText($course->episodes_count . ' episodes')
        ->assertSeeText($course->episodes_duration_sum);
});
