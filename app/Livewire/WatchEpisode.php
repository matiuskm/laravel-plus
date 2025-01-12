<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Episode;
use Livewire\Component;

class WatchEpisode extends Component
{
    public Course $course;
    public Episode $currentEpisode;

    public function mount(Course $course, Episode $episode = null)
    {
        $this->course = $course;
        $this->currentEpisode = $episode->id ? $episode : $course->episodes->first();
    }

    public function render()
    {
        return view('livewire.watch-episode');
    }
}
