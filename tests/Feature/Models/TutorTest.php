<?php

namespace Tests\Feature\Models;

use App\Models\Level;
use App\Models\Subject;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TutorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function factory_creates_associated_user(): void
    {
        $this->seed();

        $this->assertCount(0, Tutor::all());
        $this->assertCount(0, User::all());

        Tutor::factory(3)->create();

        $this->assertCount(3, Tutor::all());
        $this->assertCount(3, User::all());
    }

    #[Test]
    public function add_subject_to_tutor(): void
    {
        $this->seed();

        $tutor = Tutor::factory()->create();

        $this->assertCount(0, $tutor->subjects);

        $subject = Subject::inRandomOrder()->first();
        $levelIds = Level::inRandomOrder()->take(5)->pluck('id')->toArray();
        $tutor->addSubject($subject, $levelIds);
        $tutor->refresh();
        $this->assertCount(1, $tutor->subjects);

        $subject = Subject::inRandomOrder()->first();
        $levelIds = Level::inRandomOrder()->take(5)->pluck('id')->toArray();
        $tutor->addSubject($subject, $levelIds);
        $tutor->refresh();
        $this->assertCount(2, $tutor->subjects);
    }

    /*
     * If a tutor teaches a subject at 5 different levels, that subject should only
     * be retrieved once and not 5 times when accessing $tutor->subjects
     */
    #[Test]
    public function belongs_to_many_subjects_relationship_only_returns_distinct_subjects(): void
    {
        $this->seed();

        $tutor = Tutor::factory()->create();

        $this->assertCount(0, $tutor->subjects);

        $nSubjects = 2;

        $subjects = Subject::inRandomOrder()->take($nSubjects)->get();

        foreach ($subjects as $subject) {
            $levelIds = Level::inRandomOrder()->take(3)->pluck('id')->toArray();
            $tutor->addSubject($subject, $levelIds);
        }

        $tutor->refresh();

        $this->assertCount($nSubjects, $tutor->subjects);
    }
}
