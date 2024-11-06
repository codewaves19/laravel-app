<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
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
        'jobs' => [
            [
                'id' => 1,
                'title' => 'Director',
                'salary' => '$50,000'
            ],
            [
                'id' => 2,
                'title' => 'Programer',
                'salary' => '$150,000'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$80,000'
            ]
        ]
    ]);
});
Route::get('/jobs/{id}', function ($id) {
    $jobs = [
        [
        'id' => 1,
        'title' => 'Director',
        'salary' => '$50,000'
        ],
        [
            'id' => 2,
            'title' => 'Programer',
            'salary' => '$150,000'
        ],
        [
            'id' => 3,
            'title' => 'Teacher',
            'salary' => '$80,000'
        ]
        ];
   /* Arr::first($jobs, function ($job) use ($id) {
        if ($job['id'] == $id){
            return dd($job);
        };
    });*/

   $job = Arr::first($jobs, fn($job) => $job['id'] == $id);
    //dd($job);
   return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
    return view('contact');
});