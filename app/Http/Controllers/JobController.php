<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

// the functions called actions on a controller
class JobController extends Controller
{
    public function index()
    {
        // use latest() to display the jobs by time stamp from latest
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index',[
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        //$job = Job::find($id); to get reid of this we did the model explicit binding
        return view('jobs.show',['job' => $job]);
    }

    public function store()
    {
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
    }

    public function edit(Job $job)
    {
        return view('jobs.edit',['job' => $job]);
    }

    public function update(Job $job)
    {
        // authorize (on hold...)

        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        // another way to update the Job in db
        //    $job->title = request('title');
        //    $job->salary = request('salary');
        //    $job->save();

        //update
        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        // redirect to the job page
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        //authorize (on hold)
        // delete the job
        $job->delete();

        return redirect('/jobs');
    }
}
