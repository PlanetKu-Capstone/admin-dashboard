<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('screens.auth.login');
    }
    public function authenticate(Request $request){
       

        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $user = Auth::user();
                
            if ($user->role == 'admin') {
                $request->session()->regenerate();

                return redirect()->intended('/dashboard');
            }
            
        }

        return back()->with('loginError', 'Login Failed!');

    }

    public function logout(Request $request){
        Auth::logout();
        $request->Session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
