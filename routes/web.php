<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
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

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::get('/jobs/{job}', [JobController::class, 'show']);
Route::post('/jobs', [JobController::class, 'store']);
Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
Route::patch('/jobs/{job}', [JobController::class, 'update']);
Route::delete('/jobs/{job}', [JobController::class, 'destroy']);

Route::get('/contact', function () {
  return view('contact');
});
