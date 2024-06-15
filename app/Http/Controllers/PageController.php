<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $subjects = Subject::all();

        return view('welcome', [
            'subjects' => $subjects,
        ]);
    }

    public function dashboard()
    {
        $user = auth()->user();

        if ($user->isStudent()) {
            return redirect()->route('student.dashboard');
        } elseif ($user->isTutor()) {
            return redirect()->route('tutor.dashboard');
        } else {
            return redirect()->route('home');
        }
    }

    public function lessons()
    {
        $user = auth()->user();

        if ($user->isStudent()) {
            return redirect()->route('student.lessons.index');
        } elseif ($user->isTutor()) {
            return redirect()->route('tutor.lessons.index');
        } else {
            return redirect()->route('home');
        }
    }
}
