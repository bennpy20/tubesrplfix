<?php

namespace App\Http\Controllers;

// Import model Transaksi
use App\Models\Transaksi;
// Import model Dompet
use App\Models\Dompet;
use Brick\Math\BigInteger;
// Import return type View
use Illuminate\View\View;

//import Http Request
use Illuminate\Http\Request;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

// Import auth utk id_user
use Illuminate\Support\Facades\Auth;

// Import carbon utk date formatting
use Carbon\Carbon;

// //import Facades Storage
// use Illuminate\Support\Facades\Storage;

// Import untuk bisa mengakses database langsung
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(Request $request) : View
    {
        // Ambil filter dari parameter $request, default ke 'all' kalau tdk ada
        $filter_transaksi = $request->get('filter', 'all');

        // Get all dompets
        $dompets = Dompet::where('id_user', Auth::id())->latest()->get();
        
        // Filter transaksi berdasarkan nilai filter
        $tmp_filter = Transaksi::where('id_user', Auth::id());
        // Get all transaksi
        if ($filter_transaksi == '7_days') {
            $tmp_filter->where('date', '>=', now()->subDays(7));
        } elseif ($filter_transaksi == '1_month') {
            $tmp_filter->where('date', '>=', now()->subMonth());
        } elseif ($filter_transaksi == '3_months') {
            $tmp_filter->where('date', '>=', now()->subMonths(3));
        } elseif ($filter_transaksi == '1_year') {
            $tmp_filter->where('date', '>=', now()->subYear());
        }
        $transaksis = $tmp_filter->latest()->paginate(10);

        // Mengatur locale ke B.Indo
        Carbon::setLocale('id');

        // Format tgl utk setiap transaksi
        $transaksis->getCollection()->transform(function($transaksi) {
            $transaksi->formatted_date = Carbon::parse($transaksi->date)->isoFormat('D MMM YYYY');
            $transaksi->formatted_date_detail = Carbon::parse($transaksi->date)->isoFormat('D MMMM YYYY');
            return $transaksi;
        });

        // view(nama view) , compact(nama var diatas)
        return view('transaksis.index', compact('transaksis', 'dompets', 'filter_transaksi'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View | RedirectResponse
    {
        // Jika dompet ada, diarahkan ke form tambah transaksi
        return view('transaksis.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'label'         => 'required|max:50',
            'amount'        => 'required|numeric',
            'jenis'         => 'required',
            'note'          => 'max:255',
            'date'          => 'required',
            'id_dompet'     => 'required|numeric'
        ]);

        //create product
        Transaksi::create([
            'label'         => $request->label,
            'amount'        => $request->amount,
            'jenis'         => $request->jenis,
            'note'          => $request->note,
            'date'          => $request->date,
            'id_dompet'     => $request->id_dompet,
            'id_user'       => Auth::id() // ID pengguna yang login
        ]);

        //redirect to index
        return redirect()->route('transaksis.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(int $id): View
    {
        //get transaksi by ID
        $transaksi = Transaksi::findOrFail($id);
        
        //render view dgn var transaksi
        return view('transaksis.show', compact('transaksi'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(BigInteger $id): View
    {
        //get product by ID
        $transaksi = Transaksi::findOrFail($id);

        //render view dgn var transaksi
        return view('transaksis.edit', compact('transaksi'));
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
        //validate form
        $request->validate([
            'label'         => 'required|max:50',
            'amount'        => 'required|numeric',
            'jenis'         => 'required',
            'note'          => 'max:255',
            'date'          => 'required',
            'id_dompet'     => 'required|numeric'
        ]);

        //get product dgn ID
        $product = Transaksi::findOrFail($id);

        //update product
        $product->update([
            'label'         => $request->label,
            'amount'        => $request->amount,
            'jenis'         => $request->jenis,
            'note'          => $request->note,
            'date'          => $request->date,
            'id_dompet'     => $request->id_dompet,
            'id_user'       => Auth::id()
        ]);

        //redirect to index
        return redirect()->route('transaksis.index')->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get transaksi dgn ID
        $transaksi = Transaksi::findOrFail($id);

        //delete transaksi
        $transaksi->delete();

        //redirect to index
        return redirect()->route('transaksis.index')->with(['success' => 'Data berhasil dihapus!']);
    }

    /**
     * search
     */
    public function search(Request $request): View
    {
        // Menangkap data pencarian
        $search = $request->search;

        // Mengambil data dompets untuk dikirim ke view transaksi
        // (ini berguna saat searching, krn ada transaksi dan juga ada dompet di index punya nya si transaksi)
        $dompets = Dompet::where('id_user', Auth::id())->get();

        // Ambil filter dari parameter $request, default ke 'all' jika tdk ada
        $filter_transaksi = $request->get('filter', 'all');
        
        // Filter transaksi berdasarkan nilai filter
        $tmp_filter = Transaksi::where('id_user', Auth::id());
        // Get all transaksi
        if ($filter_transaksi == '7_days') {
            $tmp_filter->where('date', '>=', now()->subDays(7));
        } elseif ($filter_transaksi == '1_month') {
            $tmp_filter->where('date', '>=', now()->subMonth());
        } elseif ($filter_transaksi == '3_months') {
            $tmp_filter->where('date', '>=', now()->subMonths(3));
        } elseif ($filter_transaksi == '1_year') {
            $tmp_filter->where('date', '>=', now()->subYear());
        }
        $transaksis = $tmp_filter->latest()->paginate(10);
        

        // mengambil data dari tabel transaksi sesuai pencarian data
        if (empty($search)) {
            $transaksis = Transaksi::where('id_user', Auth::id())->latest()->paginate(10);
        } else {
            // Jika ada pencarian, filter data
            $transaksis = Transaksi::where('id_user', Auth::id())->where('label', 'like', "%".$search."%")->paginate(10);
        }

        // Mengatur locale ke B.Indo
        Carbon::setLocale('id');

        // Pastikan kolom "date" diformat (jika diperlukan)
        foreach ($transaksis as $transaksi) {
            $transaksi->formatted_date = Carbon::parse($transaksi->date)->isoFormat('D MMM YYYY');
            $transaksi->formatted_date_detail = Carbon::parse($transaksi->date)->isoFormat('D MMMM YYYY');
        }

        // view(nama view) , compact(nama var diatas)
        return view('transaksis.index', compact('transaksis', 'dompets', 'filter_transaksi'));
    }
}