<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function login()
    {
        # code...
        return view('auth.login');
    }
    public function register()
    {
        # code...
        return view('auth.register');
    }
    public function registerUser(Request $request)
    {
        # code...
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipe_user' => 'admin', // Tipe User = 'user'
        ]);

        return redirect()->route('login')->with('success', 'User registered successfully');
    }
    public function loginUser(Request $request)
    {
        # code...
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->tipe_user == 'admin') {
                return redirect()->intended('admin/dashboard');
            } elseif ($user->tipe_user == 'mahasiswa'){
                return redirect()->intended('mahasiswa/home');
            } else {
                return redirect()->route('login')->with('error', 'Invalid Credentials');
            }
        } else {
            return redirect()->route('login')->with('error', 'Invalid Credentials');
        }
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
