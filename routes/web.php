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

//Route::controller(JobController::class)->group(function () {
//    Route::get('/jobs',  'index');
//    Route::get('/jobs/create', 'create');
//    Route::get('/jobs/{job}', 'show');
//    Route::post('/jobs', 'store');
//    Route::get('/jobs/{job}/edit', 'edit');
//    Route::put('/jobs/{job}', 'update');
//    Route::delete('/jobs/{job}', 'destroy');
//});

Route::resource('/jobs' , JobController::class);

//Auth
Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);




