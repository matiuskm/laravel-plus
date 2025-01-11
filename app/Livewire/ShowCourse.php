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

    public function mount(Course $course)
    {
        $this->course = $course;
        $this->course->loadCount('episodes');
    }

    public function courseInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->course)
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                        Infolists\Components\TextEntry::make('title'),
                        Infolists\Components\TextEntry::make('tagline'),
                        Infolists\Components\TextEntry::make('description'),
                        Infolists\Components\TextEntry::make('instructor.name'),
                        Infolists\Components\TextEntry::make('episodes_count')
                            ->label('')
                            ->formatStateUsing(fn ($state) => "$state episodes"),
                        Infolists\Components\TextEntry::make('formatted_duration')
                            ->label(''),
                        Infolists\Components\TextEntry::make('created_at')
                            ->since(),
                        Infolists\Components\RepeatableEntry::make('episodes')
                            ->schema([
                                Infolists\Components\TextEntry::make('title'),
                                Infolists\Components\TextEntry::make('duration')
                                    ->formatStateUsing(fn ($state) => "$state mins"),
                            ]),
                    ]),
            ]);
    }

    public function render()
    {
        return view('livewire.show-course');
    }
}
