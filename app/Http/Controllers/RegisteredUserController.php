<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    // create
    public function create()
    {
        //dd('hello');
       return view('auth.register');
    }
    // store
    public function store(Request $request)
    {
        //dd($request->all());

        // validate user details
        $attributes = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(6)],
        ]);
        // create user
        $user = User::create($attributes);

        // login user
        Auth::login($user);
        // redirect
        return redirect('/jobs');
    }
}
