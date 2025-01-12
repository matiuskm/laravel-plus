<?php

use App\Livewire\WatchEpisode;
use App\Models\Course;
use App\Models\Episode;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Livewire\Livewire;

it('renders successfully', function () {
    $course = Course::factory()
        ->for(User::factory()->instructor(), 'instructor')
        ->has(Episode::factory()->state(['vimeo_id' => '123456789']), 'episodes')
        ->create();

    Livewire::test(WatchEpisode::class, ['course' => $course])
        ->assertOk();
});

it('shows the first episode if none provided', function () {
    $course = Course::factory()
        ->for(User::factory()->instructor(), 'instructor')
        ->has(Episode::factory()->state(new Sequence(
            ['overview' => 'First Episode'],
            ['overview' => 'Second Episode'],
        )), 'episodes')
        ->create();

    Livewire::test(WatchEpisode::class, ['course' => $course])
        ->assertOk()
        ->assertSeeText($course->episodes->first()->overview);
});

it('shows provided episode', function () {
    $course = Course::factory()
        ->for(User::factory()->instructor(), 'instructor')
        ->has(Episode::factory()->state(new Sequence(
            ['overview' => 'First Episode'],
            ['overview' => 'Second Episode'],
        )), 'episodes')
        ->create();

    Livewire::test(WatchEpisode::class, ['course' => $course, 'episode' => $course->episodes->last()])
        ->assertOk()
        ->assertSeeText($course->episodes->last()->overview);
});
