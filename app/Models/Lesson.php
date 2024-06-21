<?php

namespace App\Models;

use App\Enums\LessonStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'capacity',
        'starts_at',
        'ends_at',
        'subject_id',
        'tutor_id',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function tutor(): BelongsTo
    {
        return $this->belongsTo(Tutor::class);
    }

    public function courseOffering(): BelongsTo | null
    {
        return $this->belongsTo(CourseOffering::class);
    }

    public function scopeFuture($query)
    {
        return $query->where('ends_at', '>=', now());
    }

    public function scopePast($query)
    {
        return $query->where('ends_at', '<', now());
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', LessonStatus::Scheduled);
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', LessonStatus::InProgress);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', LessonStatus::Completed);
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', LessonStatus::Cancelled);
    }
}
