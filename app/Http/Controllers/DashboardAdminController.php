<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Import model Transaksi
use App\Models\Pengguna;

// Import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

// Import auth utk id_user
use Illuminate\Support\Facades\Auth;

// Import carbon utk date formatting
use Carbon\Carbon;


class DashboardAdminController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request): View
    {
        // Ambil parameter 'sort', default 'asc'
        $sort = $request->get('sort', 'asc');

        // Get all members, sorting berdasarkan 'username'
        $members = Pengguna::where('role', 'Member')->orderBy('username', $sort)->paginate(8);

        // Get all admins
        $admins = Pengguna::where('id', Auth::id())->first();

        // Mengatur locale ke B.Indo
        Carbon::setLocale('id');

        // Memformat tanggal utk setiap transaksi
        $members->getCollection()->transform(function ($member) {
            $member->formatted_date_detail = Carbon::parse($member->created_at)->isoFormat('D MMMM YYYY');
            return $member;
        });

        return view('admins.index', compact('members', 'admins'));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get transaksi by ID
        $member = Pengguna::findOrFail($id);

        //delete transaksi
        $member->delete();

        //redirect to index
        return redirect()->route('admins.index')->with(['success' => 'Data user telah dihapus!']);
    }


    /**
     * search
     */
    public function search(Request $request): View
    {
        // Menangkap data pencarian
        $search = $request->search;

        // mengambil data dari table transaksi sesuai pencarian data
        if (empty($search)) {
            $members = Pengguna::where('role', 'Member')->latest()->paginate(8);
        } else {
            // Jika ada pencarian, filter data
            $members = Pengguna::where('role', 'Member')->where('username', 'like', "%" . $search . "%")->paginate(10);
        }

        // Ambil data admin yg sedang login
        $admins = Pengguna::where('id', Auth::id())->first();

        // Mengatur locale ke B.Indo
        Carbon::setLocale('id');

        // Pastikan kolom date diformat
        foreach ($members as $member) {
            $member->formatted_date_detail = Carbon::parse($member->created_at)->isoFormat('D MMMM YYYY');
        }

        // view(nama view) , compact(nama var diatas)
        return view('admins.index', compact('members', 'admins'));
    }
}
