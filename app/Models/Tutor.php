<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tutor extends Model
{
    use HasFactory;

    protected $hidden = ['pivot'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'tutor_subject_level')
                    ->distinct();
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function courseOfferings()
    {
        return $this->HasMany(CourseOffering::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function scopeTeaches(Builder $query, $subjectId, $levelId): Builder
    {
        $tutorIds = DB::table('tutor_subject_level')
            ->where('subject_id', $subjectId)
            ->where('level_id', $levelId)
            ->pluck('tutor_id');

        return $query->whereIn('id', $tutorIds);
    }
}
