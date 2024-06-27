<?php

namespace App\Traits;

use App\Models\Review;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait Reviewable
{
    /**
     * Get all of the model's reviews.
     */
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'target');
    }
}