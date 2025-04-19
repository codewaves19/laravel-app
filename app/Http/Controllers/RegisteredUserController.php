<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    // create
    public function create()
    {
        //dd('hello');
       return view('auth.register');
    }
}
