<?php

namespace App\Http\Controllers;

// Import model Budget
use App\Models\Budget;

// Import model Dompet
use App\Models\Dompet;

use Illuminate\Http\Request;

// Import return type View
use Illuminate\View\View;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

// Import auth utk id_user
use Illuminate\Support\Facades\Auth;

// Import untuk bisa mengakses database langsung
use Illuminate\Support\Facades\DB;

class BudgetController extends Controller
{
    /**
     * index
     *
     * @return void
     */

    public function index() : View
    {
        // Dapatkan ID user yang sedang login
        $userId = Auth::id();

        // Panggil stored procedure SP_UpdateExpenseBudget untuk memperbarui kolom expense
        DB::statement('CALL SP_UpdateExpenseBudget(?)', [$userId]);

        // Get all dompets
        $dompets = Dompet::where('id_user', Auth::id())->latest()->get();

        // Ambil data budgets dari database
        $budgets = DB::table('budgets')->where('id_user', Auth::id())->get();

        // Tambahkan PeriodeBaru untuk setiap budget
        foreach ($budgets as $budget) {
            // Hitung Sisa (selisih antara income dan expense)
            $budget->sisa = $budget->income - $budget->expense;
            
            // Hitung Persentase
            $persentase = round(((1 - ($budget->expense / $budget->income)) * 100), 1);
            // Jika persentase negatif, set ke 0
            if ($persentase < 0) {
                $budget->persen = 0;  // Jika persentase negatif, set ke 0
            } else {
                $budget->persen = $persentase;  // Jika persentase positif, gunakan nilai perhitungan
            }

            // Tentukan warna berdasarkan persentase dengan transisi
            if ($budget->persen < 40) {
                $budget->color = "#DC2626";  // Merah
            } elseif (($budget->persen <= 60) && ($budget->persen >= 40)) {
                $budget->color = "#F59E0B";  // Oranye
            } else {
                $budget->color = "#059669";  // Hijau
            }

            // Tentukan status periode
            if (strtotime($budget->periode) < strtotime(date('Y-m'))) {
                // Jika periode sudah lebih dari bulan ini
                if ($budget->sisa > 0) {
                    $budget->status = 'Berhasil';
                    $budget->statusColor = "#059669";
                } else {
                    $budget->status = 'Gagal';
                    $budget->statusColor = "#DC2626";
                }
            } elseif (strtotime($budget->periode) > strtotime(date('Y-m'))) {
                // Jika periode masih mendatang
                $budget->status = 'Mendatang';
                $budget->statusColor = "#6B7280";
            } else {
                $budget->status = 'Berjalan';
                $budget->statusColor = "#3B82F6";
            }

            // Format nama periode dgn SP
            $result = DB::select('CALL SP_FormatPeriodeBudget(?)', [$budget->periode]);
            $budget->PeriodeBaru = $result[0]->PeriodeBaru ?? 'Tidak Valid';
        }

        // view(nama view) , compact(nama var diatas)
        return view('budgets.index', compact('budgets', 'dompets'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('budgets.create');
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
            'label'         => 'required|max:30',
            'income'        => 'required'
        ]);

        $bulan = $request->bulan; // Misalnya "01"
        $tahun = $request->tahun; // Misalnya "2025"
        // Gabung jadi format "2025-01"
        $periode = $tahun . '-' . $bulan;

        //create product
        Budget::create([
            'label'         => $request->label,
            'income'        => $request->income,
            'expense'       => 0,
            'periode'       => $periode,
            'id_user'       => Auth::id()
        ]);

        //redirect to index
        return redirect()->route('budgets.index')->with(['success' => 'Data berhasil disimpan!']);
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
        $budget = Budget::findOrFail($id);

        //delete transaksi
        $budget->delete();

        //redirect to index
        return redirect()->route('budgets.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}