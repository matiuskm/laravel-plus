<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function episodes(): HasMany {
        return $this->hasMany(Episode::class);
    }

    public function getFormattedDurationAttribute(): string
    {
        $totalDuration = $this->episodes->sum('duration');
        $hours = intdiv($totalDuration, 60);
        $minutes = $totalDuration % 60;

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
