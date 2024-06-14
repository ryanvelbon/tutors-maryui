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
}
