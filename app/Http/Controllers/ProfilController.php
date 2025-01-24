<?php

namespace App\Http\Controllers;

// Import model Transaksi
use App\Models\Pengguna;

// Import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

// Import auth utk id_user
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ProfilController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        // Get all users
        $users = Pengguna::where('id', Auth::id())->first();

        return view('profiles.index', compact('users'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi form
        $request->validate([
            'username'      => 'required|max:30',
            'email'         => 'required|max:80',
            'no_telepon'    => 'required|max:15'
        ]);

        //get user dgn ID
        $user = Pengguna::where('id', $id)->where('id', Auth::id())->firstOrFail();

        //update user
        $user->update([
            'username'      => $request->username,
            'email'         => $request->email,
            'no_telepon'    => $request->no_telepon,
            'role'          => $request->role
        ]);

        //redirect to index
        return redirect()->route('profiles.index')->with(['success' => 'Profil berhasil diupdate!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        // Pastikan user hanya bisa menghapus akun sndiri
        $user = Pengguna::where('id', $id)->where('id', Auth::id())->firstOrFail();

        //delete transaksi
        $user->delete();

        //redirect to index
        return redirect()->route('login')->with(['success' => 'Akun berhasil dihapus!']);
    }
}