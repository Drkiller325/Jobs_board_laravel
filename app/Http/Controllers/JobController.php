<?php

namespace App\Http\Controllers;

use App\Mail\JopPosted;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        // laravel grabs the email from the user object automatically
        Mail::to($job->employer->user)->send(
            new JopPosted($job)
        );

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        // the Gate handles that automatically | this is irrelevant
//        if (Auth::guest())
//        {
//            // has to be return to redirect
//            return redirect('/login');
//        }

        //"Gate" definition in AppService does the same thing but can be accessed from anywhere
//        if ($job->employer->user->isNot(Auth::user()))
//        {
//            abort(403);
//        }

        // handled in Routes using middleware
        //Gate::authorize('edit-job', $job);

        // another way to Handle authorization | we can use can and cannot
//        if (Auth::user()->can('edit-job', $job)) {
//            dd('failure'); // or redirect or abort or smth
//        }

        return view('jobs.edit',['job' => $job]);
    }

    public function update(Job $job)
    {
        // authorize handled in Routes using middleware
        //Gate::authorize('edit-job', $job);


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
        //authorize
        Gate::authorize('edit-job', $job);

        // delete the job
        $job->delete();

        //redirect
        return redirect('/jobs');
    }
}
