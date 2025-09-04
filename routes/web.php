<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home');
});

//index
Route::get('/jobs', function () {
    // use latest() to display the jobs by time stamp from latest
    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    return view('jobs.index',[
            'jobs' => $jobs
        ]);
});

//create
Route::get('/jobs/create', function () {
    return view('jobs.create');
});

// Needs to be close to the bottom because {id} includes anything that comes after 'jobs/'
//show
Route::get('/jobs/{id}', function ($id){
    $job = Job::find($id);
    return view('jobs.show',['job' => $job]);
});

//store
Route::post('/jobs', function () {
   request()->validate([
       'title' => ['required', 'min:3'],
       'salary' => ['required']
   ]);


    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),
        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

//edit
Route::get('/jobs/{id}/edit', function ($id){
    $job = Job::find($id);
    return view('jobs.edit',['job' => $job]);
});

//update
Route::patch('/jobs/{id}', function ($id){
    // validate
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => ['required']
    ]);
    // authorize (on hold...)
    // update
    $job = Job::findOrFail($id);

//    $job->title = request('title');
//    $job->salary = request('salary');
//    $job->save();

    $job->update([
        'title' => request('title'),
        'salary' => request('salary')
    ]);

    // redirect to the job page
    return redirect('/jobs/' . $job->id);
});

Route::delete('/jobs/{id}', function ($id){
    //authorize (on hold)
    // delete the job
    Job::findOrFail($id)->delete();

    return redirect('/jobs');
});


Route::get('/contact', function () {
    return view('contact');
});
