<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class MahasiswaController extends Controller
{
    //
    public function register()
    {
        # code...
        return view('auth.register');
    }
    public function registerMahasiswa(Request $request)
    {
        # code...
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
            'nim' => 'required|string|unique:mahasiswas,nim',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tipe_user' => 'mahasiswa', // Tipe user sebagai 'Mahasiswa'
        ]);

        Mahasiswa::create([
            'user_id' => $user->id,
            'nama' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'nim' => $request->nim,
        ]);
        return redirect()->route('login')->with('Success', 'Mahasiswa Registered Successfully');
    }
    // public function loginMahasiswa(Request $request)
    // {
    //     # code...
    //     $request->validate([
    //         'email' => 'required|string|email',
    //         'password' => 'required|string',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::guard('mahasiswas')->attempt($credentials)) {
    //         // jika login berhasil
    //         return redirect()->intended('/dashboard');
    //     } else {
    //         // jika login gagal
    //         return redirect()->route('login')->with('error', 'Invalid Credentials');
    //     }
    // }
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
