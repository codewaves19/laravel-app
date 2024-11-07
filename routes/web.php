<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
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
    //return '<h1>Hello from about page.</h1>';
    //return ['foo' => 'bar']; // return array
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});
Route::get('/jobs/{id}', function ($id) {
   /* Arr::first($jobs, function ($job) use ($id) {
        if ($job['id'] == $id){
            return dd($job);
        };
    });*/

   $job = Arr::first(Job::all(), fn($job) => $job['id'] == $id);
    //dd($job);
   return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});