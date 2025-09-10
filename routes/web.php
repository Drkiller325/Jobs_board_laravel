<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

//Rout::get('/post/{post:slug}', function ($slug) {}); this is when an instance of the post doesn't have an id
// but a unique column in the database table which is the "slug"

// Needs to be close to the bottom because {id} includes anything that comes after 'jobs/'
//the wild card (whats inside the function(here) has to be the same as the parenthesis in the URI

Route::view('/', 'home');

//Route::get('/contact', function () {
//    return view('contact');
//});

// this is the same
Route::view('/contact', 'contact');

//Jobs
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs',  'index');
    Route::get('/jobs/create', 'create');
    Route::get('/jobs/{job}', 'show');
    Route::post('/jobs', 'store')->middleware('auth');

//    Route::get('/jobs/{job}/edit', 'edit')->middleware(['auth', 'can:edit-job, job']);
    //OR this
    Route::get('/jobs/{job}/edit', 'edit')
        ->middleware('auth')
        ->can('edit', 'job'); // instead of the gate defined "edit-job" we now reference the policy "edit"

    Route::put('/jobs/{job}', 'update')->middleware('auth');
    Route::delete('/jobs/{job}', 'destroy')->middleware('auth');
});

//Route::resource('/jobs' , JobController::class)->middleware('auth');

// if we need to allow guests to access say jobs and single jobs
//Route::resource('/jobs', JobController::class)->only(['index', 'show']);
//Route::resource('/jobs', JobController::class)->except(['index', 'show'])->middleware('auth');

//Auth
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);




