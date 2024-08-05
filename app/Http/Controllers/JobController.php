<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Mail\JobPosted;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index()
    {
        // Eager Loading w/ Paginate.
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        // Eager Loading.
        //$jobs = Job::with('employer')->get();

        // Lazy Loading.
        //$jobs = Job::all();

        return view('jobs.index', [
            'title' => 'Jobs Landing Page',
            'jobs' => $jobs
        ]);
    }

    public function create(Job $job)
    {
        return view('jobs.create', ['job' => $job]);
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        request()->validate([
            'title' => 'required|string|min:3',
            'salary' => 'required|numeric',
        ]);
        $user = Auth::user();

        // First
        $employer = $user->employers->first() ?? 1;

        // Last
        //$employer = $user->employers->last() ?? 1;

        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => $employer->id,
        ]);

        Mail::to($job->employer->user)->queue(new JobPosted($job));

        if ($job)
            return redirect('/jobs');
        else
            dd("Job Failed - " + request()->all());
    }

    public function edit(Job $job)
    {
        if (Auth::guest())
            return redirect('login');

        // Authorization Type 1: Using Gate Authorize.
        //Gate::authorize('edit-job', $job);
        // Authorization Type 2: Using User Can/Cannot.
        //if (Auth::user()->cannot('edit-job', $job))
        // abort(403);
        // Authorization Type 3: Using Middleware on routes (web.php).

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // On Hold (Validation) until we learn about authentication.
        request()->validate([
            'title' => 'required|string|min:3',
            'salary' => 'required|numeric',
        ]);

        $job->title = request('title');
        $job->salary = request('salary');
        $job->save();

        /*
        $job = Job::update($id, [
            'title' => request('title'),
            'salary' => request('salary'),
        ]);
        */

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // On Hold (Validation) until we learn about authentication.
        $job->delete();

        return redirect('/jobs');
    }
}
