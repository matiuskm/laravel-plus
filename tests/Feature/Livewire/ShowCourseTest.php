<?php

use App\Livewire\ShowCourse;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ShowCourse::class)
        ->assertNotOk();
});

it('show course details', function() {
    // arrange
    $course = App\Models\Course::factory()
        ->create();

    // act & assert
    Livewire::test(ShowCourse::class, ['course' => $course])
        ->assertOk()
        ->assertSeeText($course->title)
        ->assertSeeText($course->tagline);
});
