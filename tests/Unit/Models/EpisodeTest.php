<?php

it('has the formatted duration', function () {
    $episode = App\Models\Episode::factory(['duration' => 150])
        ->for(
            App\Models\Course::factory()
                ->for(App\Models\User::factory()->instructor(), 'instructor')
        )
        ->create();

    expect($episode->formatted_duration)->toBe('2 hrs 30 mins');
});
