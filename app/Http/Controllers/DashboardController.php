<?php

namespace App\Http\Controllers;

// Import model Transaksi
use App\Models\Transaksi;

// Import model Transaksi
use App\Models\Budget;

// Import auth utk id_user
use Illuminate\Support\Facades\Auth;

// Import untuk bisa mengakses database langsung
use Illuminate\Support\Facades\DB;

// Import carbon utk date formatting
use Carbon\Carbon;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Tampung id user yg sedang login
        $id_user = Auth::id();

        // SP menghitung total pemasukan
        $hitungPemasukan = DB::select('CALL SP_TotalPemasukan(?)', [$id_user]);
        $jml_pemasukan = $hitungPemasukan[0]->TotalPemasukan;

        // SP menghitung total pengeluaran
        $hitungPengeluaran = DB::select('CALL SP_TotalPengeluaran(?)', [$id_user]);
        $jml_pengeluaran = $hitungPengeluaran[0]->TotalPengeluaran;

        // SP menghitung total saldo
        $hitungSaldo = DB::select('CALL SP_TotalSaldo(?)', [$id_user]);
        $jml_saldo = $hitungSaldo[0]->TotalSaldo;

        // Get all transaksi
        $transaksis = Transaksi::where('id_user', Auth::id())->latest()->paginate(6);

        // Mengatur locale ke B.Indo
        Carbon::setLocale('id');

        // Memformat tgl utk setiap transaksi
        $transaksis->getCollection()->transform(function($transaksi) {
            $transaksi->formatted_date = Carbon::parse($transaksi->date)->isoFormat('D MMM YYYY');
            return $transaksi;
        });

        // Ambil bulan dan tahun saat ini (format: "2025-01")
        $periode_skrg = Carbon::now()->format('Y-m');

        $budgets = Budget::where('id_user', Auth::id())->get();

        // Hitung jml data budget dengan periode yg sama dengan bulan ini
        $hitung_budget = Budget::where('periode', $periode_skrg)->where('id_user', Auth::id())->count();

        return view('home', compact('transaksis', 'jml_pemasukan', 'jml_pengeluaran', 'jml_saldo', 'hitung_budget', 'budgets'));
    }
}
