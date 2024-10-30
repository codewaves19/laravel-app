<?php

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

Route::get('/', function () {
    return view('home', ['name' => 'Samantha']);
});
Route::get('/about', function () {
    //return '<h1>Hello from about page.</h1>';
    //return ['foo' => 'bar']; // return array
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});