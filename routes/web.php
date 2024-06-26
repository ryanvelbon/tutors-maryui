<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Livewire\CourseIndex;
use App\Livewire\TutorIndex;
use App\Livewire\Panel\EditProfile;
use App\Livewire\Panel\Settings;
use App\Livewire\Student\Dashboard as StudentDashboard;
use App\Livewire\Student\LessonIndex as StudentLessonIndex;
use App\Livewire\Tutor\Dashboard as TutorDashboard;
use App\Livewire\Tutor\CourseCreate as TutorCourseCreate;
use App\Livewire\Tutor\CourseIndex as TutorCourseIndex;
use App\Livewire\Tutor\CourseOfferingCreate as TutorCourseOfferingCreate;
use App\Livewire\Tutor\CourseOfferingIndex as TutorCourseOfferingIndex;
use App\Livewire\Tutor\LessonIndex as TutorLessonIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Confirm;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Auth\Passwords\Reset;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\RegisterAs;
use App\Livewire\Auth\Verify;
use Illuminate\Support\Facades\Route;


Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/courses', CourseIndex::class)->name('courses.index');

Route::get('/tutors', TutorIndex::class)->name('tutors.index');
Route::get('/tutors/{subject:slug}/{level:slug}', [TutorController::class, 'indexBySubjectAndLevel'])->name('tutors.index.by-subject-and-level');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('register/account-type', RegisterAs::class)->name('account.type');
    Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('lessons', [PageController::class, 'lessons'])->name('lessons');
    Route::get('profile/edit', EditProfile::class)->name('account.profile');
    Route::get('account/settings', Settings::class)->name('account.settings');
});


Route::middleware('account:student')->group(function () {
    Route::get('student/dashboard', StudentDashboard::class)->name('student.dashboard');
    Route::get('student/lessons', StudentLessonIndex::class)->name('student.lessons.index');
});

Route::middleware('account:tutor')->group(function () {
    Route::get('tutor/dashboard', TutorDashboard::class)->name('tutor.dashboard');

    Route::get('tutor/courses', TutorCourseIndex::class)->name('tutor.courses.index');
    Route::get('tutor/courses/create', TutorCourseCreate::class)->name('tutor.courses.create');

    Route::get('tutor/course-offerings', TutorCourseOfferingIndex::class)->name('tutor.courseOfferings.index');
    Route::get('tutor/course-offerings/create', TutorCourseOfferingCreate::class)->name('tutor.courseOfferings.create');

    Route::get('tutor/lessons', TutorLessonIndex::class)->name('tutor.lessons.index');
});
