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
                Infolists\Components\TextEntry::make('title')
                            ->label('')
                            ->size('text-3xl')
                            ->weight('font-bold')
                            ->columnSpanFull(),
                Infolists\Components\Grid::make(3)
                    ->schema([
                    Infolists\Components\Section::make([
                        Infolists\Components\Fieldset::make('')
                            ->columns(5)
                            ->columnSpan(1)
                            ->schema([
                                Infolists\Components\TextEntry::make('episodes_count')
                                    ->label('')
                                    ->icon('heroicon-o-film')
                                    ->formatStateUsing(fn ($state) => "$state episodes"),
                                Infolists\Components\TextEntry::make('formatted_duration')
                                    ->label('')
                                    ->icon('heroicon-o-clock'),
                                Infolists\Components\TextEntry::make('created_at')
                                    ->label('')
                                    ->icon('heroicon-o-calendar')
                                    ->since(),
                            ])
                            ->extraAttributes(['class' => 'border-none !p-0']),
                        Infolists\Components\TextEntry::make('description')
                            ->label('Overview'),
                        Infolists\Components\TextEntry::make('tagline')
                            ->label('')
                            ->columnSpanFull(),
                        Infolists\Components\TextEntry::make('instructor.name')
                            ->label('Your teacher')
                            ->columnSpanFull(),
                    ])->columnSpan(2),
                    Infolists\Components\Section::make([
                        Infolists\Components\RepeatableEntry::make('episodes')
                        ->schema([
                            Infolists\Components\TextEntry::make('title')
                                ->label('')
                                ->icon('heroicon-o-play-circle'),
                            Infolists\Components\TextEntry::make('duration')
                                ->label('')
                                ->formatStateUsing(fn ($state) => "$state mins"),
                        ]),
                    ])
                    ->columnSpan(1),
                ]),
            ]);
    }

    public function render()
    {
        return view('livewire.show-course');
    }
}
