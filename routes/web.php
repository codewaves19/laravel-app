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

// index
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

// Create
Route::get('/jobs/create', function () {
 //dd($job);
   return view('jobs.create');
 });

 // Store
 Route::post('/jobs', function () {
    //dd(request()->all());
    // skipping validation

    //client side validation is that which field is required to be not empty so go to form view and add required attribute to input tag
    // here is server side validation
    // provide here one or more validations rules
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

// Show
Route::get('/jobs/{id}', function ($id) {
   $job = Job::find($id);
//dd($job);
  return view('jobs.show', ['job' => $job]);
});

// Edit
Route::get('/jobs/{id}/edit', function ($id) {
  $job = Job::find($id);
//dd($job);
 return view('jobs.edit', ['job' => $job]);
});

// Update
Route::patch('/jobs/{id}', function ($id) {
  // validate
  request()->validate([
    'title' => ['required', 'min:3'],
    'salary' => ['required']
  ]);
  // autheticate whether user has permission to update
  // update the Job
  //$job = Job::find($id); // if id doesnot exist it will return NULL, so we use findOrFail() method and laravel will display apropriate message to user
  $job = Job::findOrFail($id);
  // research on Route Model Binding to get laravel do all fetching work and avoid manual fetching of data
  
  // method 1 to update data
  //$job->title = request('title');
  //$job->salary = request('salary');
  //$job->save();

  // Method 2 to update data
  $job->update([
    'title' => request('title'),
    'salary' => request('salary')
  ]);
  // and persist
  // redirect to job page
return redirect('/jobs/'.$job->id);

});

// Destroy
Route::delete('/jobs/{id}', function ($id) {
  // autherize the request

  // Delete the Job
  $job = Job::findOrFail($id);
  $job->delete();
  // redirect
  return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact');
});