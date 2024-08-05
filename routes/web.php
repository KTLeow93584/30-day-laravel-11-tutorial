<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;

use App\Jobs\TranslateJob;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {
    $job = Job::first();
    TranslateJob::dispatch($job);
    return 'Done';
});

Route::view('/', 'home', ['title' => 'Greetings from the Home Page']);
Route::view('/about', 'about', ['title' => 'Greetings from the About Page']);
Route::get('/contact', [ContactController::class, 'index']);

// Declares a default GET/POST/PUT or PATCH/DELETE route for each resource.
//Route::resource('jobs', JobController::class)->except(['index', 'show'])->middleware('auth');
//Route::resource('jobs', JobController::class)->only(['index', 'show']);

// Route::resource('jobs', JobController::class, [
//     'only' => ['index', 'show', 'create',]
// ]);

// Route::resource('jobs', JobController::class, [
//     'except' => ['index', 'show', 'create',]
// ]);

Route::controller(JobController::class)->group(function () {
    // Jobs Listing Page.
    Route::get('/jobs', 'index');

    // New Job Storage/Creation Page.
    Route::get('/jobs/create', 'create')->middleware('auth');

    // POST API to Submit a New Job.
    Route::post('/jobs', 'store')->middleware('auth');

    // PATCH API to Update an Existing Job.
    Route::patch('/jobs/{job}', 'update')->middleware('auth', 'can:edit-job,job');
    Route::get('/jobs/{job}/edit', 'edit')
        ->middleware('auth')
        ->can('edit', 'job');

    // DELETE API to Update an Existing Job.
    Route::delete('/jobs/{job}', 'destroy')->middleware('auth');

    // Single Job Preview/Show Page
    Route::get('/jobs/{job}', 'show');
});

// Auth
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);