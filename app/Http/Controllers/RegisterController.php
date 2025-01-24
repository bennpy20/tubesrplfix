<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Session;

use App\Models\Pengguna;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    
    public function actionregister(Request $request)
    {
        //validate form
        $request->validate([
            'username'      => 'required|max:30',
            'password'      => 'required|max:50',
            'email'         => 'required|max:80',
            'no_telepon'    => 'required|max:15'
        ]);

        $user = Pengguna::create([
            'username'      => $request->username,
            'password'      => Hash::make($request->password),
            'email'         => $request->email,
            'no_telepon'    => $request->no_telepon,
            'role'          => $request->role
        ]);
        
        //redirect to login page
        return redirect()->route('login')->with(['success' => 'Register berhasil! Silakan login menggunakan username dan password.']);
    }
}
