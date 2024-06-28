<?php

namespace App\Models;

use App\Traits\Reviewable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class Tutor extends Model
{
    use HasFactory;
    use Reviewable;

    protected $fillable = [
        'price_per_hour_individual',
        'price_per_hour_group',
    ];

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

    public function addSubject(Subject $subject, array $levelIds): void
    {
        foreach ($levelIds as $id) {
            $this->subjects()->attach($subject, ['level_id' => $id]);
        }
    }

    public function getSubjectLevelsAttribute()
    {
        $records = DB::table('tutor_subject_level')
                    ->join('subjects', 'tutor_subject_level.subject_id', '=', 'subjects.id')
                    ->join('levels', 'tutor_subject_level.level_id', '=', 'levels.id')
                    ->where('tutor_id', $this->id)
                    ->select(
                        'subjects.id as subject_id',
                        'subjects.title as subject_title',
                        'levels.id as level_id',
                        'levels.title as level_title',
                    )
                    ->get();

        return $records;
    }
}
