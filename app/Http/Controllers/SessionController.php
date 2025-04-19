<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    // create_function
    public function create()
    {
        return view('auth.login');
    }

    // store_function
    public function store(Request $request)
    {
        dd($request->all());
    }

}
