<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SignUpUserRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class AuthController extends Controller
{
    public function index()
    {
        return "Halo ini adalah method index, dalam controller SiswaController";
    }
    public function login_page()
    {
        return view('login_page');
    }
    public function login(Request $request)
    {
        request()->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ]);

        $kredensil = $request->only('email','password');

            if (Auth::attempt($kredensil)) {
                $user = Auth::user();
                return redirect()->intended('/dashboard');
            }

        return redirect('/')->with(['error' => 'Email Tidak Ditemukan !']);


        // $role = $this->user->roleRelations($user);
        // $this->setUserSession($user,$role);
        // return redirect('menu');
    }

    public function logout(Request $request)
    {
        Auth::logout();
 
        request()->session()->invalidate();
 
        request()->session()->regenerateToken();
 
        return redirect('/');
    }

    
}
