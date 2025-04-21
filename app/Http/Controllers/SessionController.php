<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        //dd($request->all());
        // validate
        $attributes = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // attempt to login user
        if(!Auth::attempt($attributes)){
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials, try again'
            ]);
        } // attempt to log in the user
        // regenerate session token
        $request->session()->regenerate(); // regenerate session token
        // redirect
        return redirect()->intended('/jobs')->with('success', 'Logged in successfully'); // redirect after login
    }

    // destroy_function
    public function destroy()
    {
        // logout user
        auth()->logout(); // current user
        // redirect
        return redirect('/');
    }

}
