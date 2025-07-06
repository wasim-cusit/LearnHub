<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LearningTaskController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LearningRedirect;


Route::get('/', function () {
    return view('welcome');
});

// redirect to start-learning button
Route::get('/start-learning', [LearningRedirect::class, 'redirect'])->name('startLearning');
// redirect to Get Started
Route::get('/getStarted', [LearningRedirect::class, 'redirectToDashboard'])->name('getStarted');
// redirect to about us
Route::get('/learnMore', [LearningRedirect::class, 'redirectToAboutUs'])->name('learnMore');
Route::get('/about-us', [LearningRedirect::class, 'redirectToAboutUs'])->name('about.us');

// Role-based dashboard routes
Route::get('/dashboard', [DashboardController::class, 'redirectToDashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/teacher/dashboard', [DashboardController::class, 'teacherDashboard'])->middleware(['auth', 'verified', 'role:teacher'])->name('teacher.dashboard');
Route::get('/student/dashboard', [DashboardController::class, 'studentDashboard'])->middleware(['auth', 'verified', 'role:student'])->name('student.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Task routes
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/toggle-status', [TaskController::class, 'toggleStatus'])->name('tasks.toggle-status');

    // Teacher: list all students
    Route::get('/students', [TaskController::class, 'students'])->name('students.index');

    // Learning Tasks routes
    Route::resource('learning-tasks', LearningTaskController::class);
    Route::patch('/learning-tasks/{learningTask}/update-status', [LearningTaskController::class, 'updateStatus'])->name('learning-tasks.update-status');
    Route::get('/learning-dashboard', [LearningTaskController::class, 'dashboard'])->name('learning-tasks.dashboard');
});

require __DIR__.'/auth.php';
