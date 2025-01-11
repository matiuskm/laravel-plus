<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Episode extends Model
{
    /** @use HasFactory<\Database\Factories\EpisodeFactory> */
    use HasFactory;

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getFormattedDurationAttribute(): string
    {
        $hours = intdiv($this->duration, 60);
        $minutes = $this->duration % 60;

        $result = [];
        if ($hours > 0) {
            $result[] = $hours . ' hr' . ($hours > 1 ? 's' : '');
        }
        if ($minutes > 0 || $hours === 0) {
            $result[] = $minutes . ' min' . ($minutes > 1 ? 's' : '');
        }

        return implode(' ', $result);
    }
}
