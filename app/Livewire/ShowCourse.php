<?php

namespace App\Livewire;

use App\Models\Course;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Filament\Infolists;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class ShowCourse extends Component implements HasInfolists, HasForms
{
    use InteractsWithInfolists, InteractsWithForms;

    public Course $course;

    public function courseInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->course)
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('title'),
                        Infolists\Components\TextEntry::make('tagline'),
                    ]),
            ]);
    }

    public function render()
    {
        return view('livewire.show-course');
    }
}
