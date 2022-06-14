<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthenticationController extends Controller
{
    public function login(Request $request){

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(! auth()->attempt($validated)){
            return [
                'message' => 'wrong credentials',
            401];
        }

        $request->session()->regenerate();

        Session::put('user',auth()->user());
//        session(['user' => auth()->user()]);

//        dd(session('user'));
        Session::save();
        return [
            'message' => 'authenticated successfully!',
            'user' => auth()->user(),
        201];
    }

    public function check(){
        dd(Auth::user());
    }
}
