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

Route::get('/', function () {
    return view('home');
});
Route::get('/jobs', function () {
    $jobs = Job::with('employer')->latest()->paginate(3); // get all records using Eager Loading
    //$jobs = Job::with('employer')->simplePaginate(3); // just next and previous buttons
    //$jobs = Job::with('employer')->cursorPaginate(3); // no page number is shown in url

    //$jobs = Job::all(); // Lazy Loading
	// Eager load employer relationship
	// give me all jobs with the employer for each one
    // select * from `employers` where `employers`.`id` in (1, 2, 3, 4, 5, 6, 7, 8, 9, 10)
    // one single query
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function () {
 //dd($job);
   return view('jobs.create');
 });

 Route::post('/jobs', function () {
    //dd(request()->all());
    // skipping validation
    Job::create([
      'title' => request('title'),
      'salary' => request('salary'),
      'employer_id' => 1
    ]);

    return redirect('jobs');
    });

Route::get('/jobs/{id}', function ($id) {
   $job = Job::find($id);
//dd($job);
  return view('jobs.show', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});