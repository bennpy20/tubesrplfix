<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// utk auth dan sessionnya
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect('home');
        }else{
            return view('login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            // Periksa role pengguna
            $user = Auth::user();
            if ($user->role == 'Admin') {
                // Arahkan ke page dashboard admin jika role Admin
                return redirect()->route('admins.index');
            } else {
                // Arahkan ke page home untuk role Member
                return redirect()->route('home');
            }
        } else {
            Session::flash('error', 'Email atau password salah!');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
