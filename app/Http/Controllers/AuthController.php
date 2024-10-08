<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    // Register a user
    public function register(Request $request){
        $fields = $request->validate(
           [
            'name' => ['required','max:255'],
            'password' => ['required','max:255','min:5','confirmed'],
            'email' => ['required','max:255','email','unique:users']
           ]
        );

        $user = User::create($fields);
        Auth::login($user);
        event(new Registered($user));

        return redirect()->route('posts.index');
    }
    public function login(Request $request){
        $fields = $request->validate(
           [
            'password' => ['required'],
            'email' => ['required','max:255','email']
           ]
        );

        if(Auth::attempt($fields, $request->remember)){
            return redirect()->route('posts.index');
        }
        return back()->withErrors(['failed'=>'The provided credentials does not match']);

        //return redirect()->route('posts.index');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
