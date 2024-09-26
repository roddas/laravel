<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        return redirect()->route('home');
    }
    public function login(Request $request){
        $fields = $request->validate(
           [
            'password' => ['required'],
            'email' => ['required','max:255','email']
           ]
        );

        if(Auth::attempt($fields, $request->remember)){
            return redirect()->route('home');
        }
        return back()->withErrors(['failed'=>'The provided credentials does not match']);

        //return redirect()->route('home');
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
