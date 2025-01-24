<?php

namespace App\Http\Controllers;

// Import model Transaksi
use App\Models\Dompet;

// Import return type View
use Illuminate\View\View;

//import Http Request
use Illuminate\Http\Request;

//import return type redirectResponse
use Illuminate\Http\RedirectResponse;

// Import untuk bisa mengakses database langsung
use Illuminate\Support\Facades\DB;

// Import BigInt
use Brick\Math\BigInteger;

// Import auth utk id_user
use Illuminate\Support\Facades\Auth;

class DompetController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index() : View
    {
        // Get all dompets
        $dompets = Dompet::where('id_user', Auth::id())->oldest()->get();

        // Tampung nilai id user
        $userId = Auth::id();

        // Tampilkan SP_TotalDompet
        $total_dompet = DB::select('CALL SP_TotalDompet(?)', [$userId]);

        // Untuk warna background
        foreach ($dompets as $dompet) {
            // Tampung jml saldo
            $tmp_saldo = $dompet->current_amount;

            if ($tmp_saldo < 0) {
                $dompet->bg_color = "#EF4444, #DC2626, #B91C1C"; // merah
            } else if ($tmp_saldo >= 0 && $tmp_saldo < 500000) {
                $dompet->bg_color = "#00BCD4, #00ACC1, #0097A7"; // biru
            } else if ($tmp_saldo >= 500000 && $tmp_saldo < 1000000) {
                $dompet->bg_color = "#26A69A, #009688, #00796B"; // teal
            } else {
                $dompet->bg_color = "#F59E0B, #D97706, #B45309"; // emas
            }
        }

        // view(nama view) , compact(nama var diatas)
        return view('dompets.index', compact('dompets', 'total_dompet'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('dompets.create');
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
            'label'          => 'required|max:50',
        ]);

        
        //create product
        Dompet::create([
            'label'          => $request->label,
            'current_amount' => 0,
            'id_user'        => Auth::id()
        ]);

        //redirect to index
        return redirect()->route('dompets.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(BigInteger $id): View
    {
        //get dompet dgn ID
        $dompet = Dompet::findOrFail($id);

        //render view with product
        return view('dompets.edit', compact('dompet'));
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
        ]);

        //get product dgn ID
        $dompet = Dompet::findOrFail($id);

        //update product
        $dompet->update([
            'label'         => $request->label
        ]);

        //redirect to index
        return redirect()->route('dompets.index')->with(['success' => 'Data berhasil diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get dompet dgn ID
        $dompet = Dompet::findOrFail($id);

        //delete dompet
        $dompet->delete();

        //redirect to index
        return redirect()->route('dompets.index')->with(['success' => 'Data berhasil dihapus!']);
    }
}