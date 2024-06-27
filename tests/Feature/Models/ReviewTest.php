<?php

namespace Tests\Feature\Models;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Tutor;
use App\Models\User;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_review_tutor(): void
    {
        $this->seed();

        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $tutor = Tutor::factory()->create();

        $this->assertCount(0, $tutor->reviews);

        Review::create([
            'user_id' => $userA->id,
            'target_id' => $tutor->id,
            'target_type' => Tutor::class,
            'comment' => "Excellent tutor!",
            'rating' => 5,
        ]);

        $tutor->refresh();
        $this->assertCount(1, $tutor->reviews);

        Review::create([
            'user_id' => $userB->id,
            'target_id' => $tutor->id,
            'target_type' => Tutor::class,
            'comment' => "Good tutor!",
            'rating' => 4,
        ]);

        $tutor->refresh();
        $this->assertCount(2, $tutor->reviews);

        // $this->assertEquals(4.5, $tutor->rating); // check average rating
    }

    #[Test]
    public function can_review_course(): void
    {
        $this->seed();

        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $course = Course::factory()->create();

        $this->assertCount(0, $course->reviews);

        Review::create([
            'user_id' => $userA->id,
            'target_id' => $course->id,
            'target_type' => Course::class,
            'comment' => "Excellent course!",
            'rating' => 5,
        ]);

        $course->refresh();
        $this->assertCount(1, $course->reviews);

        Review::create([
            'user_id' => $userB->id,
            'target_id' => $course->id,
            'target_type' => Course::class,
            'comment' => "Good course!",
            'rating' => 4,
        ]);

        $course->refresh();
        $this->assertCount(2, $course->reviews);
    }

    #[Test]
    public function can_review_lesson(): void
    {
        $this->seed();

        $userA = User::factory()->create();
        $userB = User::factory()->create();

        $lesson = Lesson::factory()->create();

        $this->assertCount(0, $lesson->reviews);

        Review::create([
            'user_id' => $userA->id,
            'target_id' => $lesson->id,
            'target_type' => Lesson::class,
            'comment' => "Excellent lesson!",
            'rating' => 5,
        ]);

        $lesson->refresh();
        $this->assertCount(1, $lesson->reviews);

        Review::create([
            'user_id' => $userB->id,
            'target_id' => $lesson->id,
            'target_type' => Lesson::class,
            'comment' => "Good lesson!",
            'rating' => 4,
        ]);

        $lesson->refresh();
        $this->assertCount(2, $lesson->reviews);
    }

    #[Test]
    public function model_has_many_reviews(): void
    {
        $tutor = Tutor::factory()->hasReviews(13)->create();
        $this->assertCount(13, $tutor->reviews);

        $course = Course::factory()->hasReviews(5)->create();
        $this->assertCount(5, $course->reviews);

        $lesson = Lesson::factory()->hasReviews(7)->create();
        $this->assertCount(7, $lesson->reviews);
    }
}
