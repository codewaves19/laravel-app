<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Till now we learnt about code for small projects but for large projects we use dedicated controllers, check it now...

Route::get('/', function () {
  return view('home');
});

// index
Route::get('/jobs', function () {
  $jobs = Job::with('employer')->latest()->paginate(3);
  return view('jobs.index', [
    'jobs' => $jobs
  ]);
});

// Create
Route::get('/jobs/create', function () {
  return view('jobs.create');
});

// Show
Route::get('/jobs/{job}', function (Job $job) {
  return view('jobs.show', ['job' => $job]);
});

// Store
Route::post('/jobs', function () {
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
});

// Edit
Route::get('/jobs/{job}/edit', function (Job $job) {
  return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{job}', function (Job $job) {
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
});

// Destroy
Route::delete('/jobs/{job}', function (Job $job) {
  // autherize the request

  $job->delete();

  return redirect('/jobs');
});

Route::get('/contact', function () {
  return view('contact');
});
