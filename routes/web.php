<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Middleware\Admin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Router for profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/all-courses', [CourseController::class, 'allCourses'])->name('course.allcourses');
    // Router for courses
    Route::get('/my-courses', [CourseController::class, 'myCourses'])->name('course.mycourses');
    // Router for lessons
    Route::get('/course/{id}/lessons', [LessonController::class, 'index'])->name('lesson.index')->where('id', '[0-9]+');
    // Router for Enroll Courses
    Route::get('/enroll-course/{id}', [CourseController::class, 'enrollCourse'])->name('course.enrollCourse')->where('id', '[0-9]+');
    Route::delete('/unenroll-course/{id}', [CourseController::class, 'unenrollCourse'])->name('course.unenrollCourse')->where('id', '[0-9]+');
});

Route::middleware([Admin::class])->group(function () {
    Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
    Route::get('/course/create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course', [CourseController::class, 'store'])->name('course.store');
    Route::get('/course/{id}/edit', [CourseController::class, 'edit'])->name('course.edit')->where('id', '[0-9]+');
    Route::put('/course/{id}', [CourseController::class, 'update'])->name('course.update')->where('id', '[0-9]+');
    Route::delete('/course/{id}', [CourseController::class, 'destroy'])->name('course.destroy')->where('id', '[0-9]+');
    Route::get('/lesson/create/{id?}', [LessonController::class, 'create'])->name('lesson.create');
    Route::get('/lesson/{id}/edit', [LessonController::class, 'edit'])->name('lesson.edit')->where('id', '[0-9]+');
    Route::put('/lesson/{id}', [LessonController::class, 'update'])->name('lesson.update')->where('id', '[0-9]+');
    Route::delete('/lesson/{id}', [LessonController::class, 'destroy'])->name('lesson.destroy')->where('id', '[0-9]+');
    Route::post('/lesson', [LessonController::class, 'store'])->name('lesson.store');
});

Route::fallback(function () {
    return abort(404, "Page not found");
});
require __DIR__ . '/auth.php';
