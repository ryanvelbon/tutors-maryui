<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Level extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'code',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($level) {
            $level->slug = Str::slug($level->title);
        });
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function courseOffering(): HasMany
    {
        return $this->hasMany(CourseOffering::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
