<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\Subject;
use App\Models\Tutor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TutorController extends Controller
{
    public function indexBySubjectAndLevel(Subject $subject, Level $level)
    {
        $tutorIds = DB::table('tutor_subject_level')
            ->where('subject_id', $subject->id)
            ->where('level_id', $level->id)
            ->pluck('id');

        $tutors = Tutor::query()
            ->with('user.locality')
            ->findMany($tutorIds);

        return view('pages.tutors.index', [
            'subject' => $subject,
            'level' => $level,
            'tutors' => $tutors,
        ]);
    }

    public function show(User $user)
    {
        if (!$user->isTutor()) {
            abort(404);
        }

        $tutor = Tutor::where('user_id', $user->id)->first();

        return view('pages.tutors.show', [
            'tutor' => $tutor,
        ]);
    }
}
