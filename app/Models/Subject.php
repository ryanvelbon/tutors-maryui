<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'slug',
    ];

    protected $hidden = ['pivot'];

    public function levels(): BelongsToMany
    {
        return $this->belongsToMany(Level::class);
    }

    public function tutors(): BelongsToMany
    {
        return $this->belongsToMany(Tutor::class, 'tutor_subject_level')
                    ->distinct();
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
