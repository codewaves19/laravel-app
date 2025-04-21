<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    // index
    public function index()
    {
        $jobs = Job::with('employer')->latest()->paginate(3);
        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }
    // Create
    public function create()
    {
        return view('jobs.create');
    }
    // Show
    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }
    // Store
    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);
        // if the above validation fails it will never run the next link and returns back to previous url
        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1
        ]);

        return redirect('jobs');
    }
    // Edit
    public function edit(Job $job)
    {
        Gate::define('edit-job', function (User $user, Job $job) {
            return $job->employer->user->is($user);
        });

        if (Auth::guest()) {
            return redirect('/login');
        }

        Gate::authorize('edit-job', $job); // authorize the user to edit the job and abort if not authorized

        // if we dont want to abort then
        // if (Gate::denies('edit-job', $job)) {
        //     return redirect('/jobs')->with('error', 'You are not authorized to edit this job');
        // }


        // authorize here
        //if ($job->employer->user->isNot(Auth::user())) { // is employer is not same as current user
           // abort(403);
        //}
        return view('jobs.edit', ['job' => $job]);
    }
    // Update
    public function update(Job $job)
    {
        // authorize here

        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required']
        ]);

        $job->update([
            'title' => request('title'),
            'salary' => request('salary')
        ]);

        return redirect('/jobs/' . $job->id);
    }
    // Destroy
    public function destroy(Job $job)
    {
        // authorize here
        $job->delete();
        return redirect('/jobs');
    }
}
