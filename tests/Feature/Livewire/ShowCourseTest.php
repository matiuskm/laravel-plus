<?php

use App\Livewire\ShowCourse;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ShowCourse::class)
        ->assertOk();
});

it('show course details', function() {
    // arrange
    $course = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(App\Models\Episode::factory()->state(['duration' => 10])->count(10), 'episodes')
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
        ->assertSeeText($course->formatted_duration);
});

it('shows the episodes list', function () {
    $course = App\Models\Course::factory()
        ->for(App\Models\User::factory()->instructor(), 'instructor')
        ->has(
            App\Models\Episode::factory()
                ->count(3)
                ->state(new Sequence(
                    ['title' => 'Episode 1', 'duration' => 5],
                    ['title' => 'Episode 2', 'duration' => 10],
                    ['title' => 'Episode 3', 'duration' => 1],
                )
            )
        )->create();

    Livewire::test(ShowCourse::class, ['course' => $course])
        ->assertOk()
        ->assertSeeText('Episode 1')
        ->assertSeeText('5 mins')
        ->assertSeeText('Episode 2')
        ->assertSeeText('10 mins')
        ->assertSeeText('Episode 3')
        ->assertSeeText('1 min');
});
