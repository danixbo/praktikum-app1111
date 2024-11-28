<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meja;

class EntriMejaController extends Controller
{
    
    public function index() {
        if(auth()->guard('user')->user()->role != 'admin') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak mempunyai permission untuk masuk ke halaman Meja!');
        }
        
        $data_meja = Meja::paginate(10);
        
        $last_meja = Meja::orderBy('nomor_meja', 'desc')->first();
        $next_number = $last_meja ? (int)substr($last_meja->nomor_meja, 2) + 1 : 1;
        
        $formatted_number = sprintf("M-%03d", $next_number);

        return view('entriMeja', [
            'mejas' => $data_meja,
            'nomor_meja' => $formatted_number
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required',
            'kapasitas' => 'required|numeric',
            'status' => 'required|in:tersedia,terisi',
        ]);

        $last_meja = Meja::orderBy('nomor_meja', 'desc')->first();
        $next_number = $last_meja ? (int)substr($last_meja->nomor_meja, 2) + 1 : 1;
        $formatted_number = sprintf("M-%03d", $next_number);

        $meja = new Meja();
        $meja->nomor_meja = $formatted_number;
        $meja->kapasitas = $request->kapasitas;
        $meja->status = $request->status;
        $meja->save();

        return redirect()->route('meja')->with('success', 'Data meja berhasil ditambahkan!');
    }

    public function edit_data($id_meja) 
    {
        $meja = Meja::find($id_meja);
        $data_meja = Meja::paginate(10);
        return view('entriMeja', [
            'mejas' => $data_meja,
            'edit' => $meja,
        ]);
    }

    public function update(Request $request, $id_meja) 
    {
        $request->validate([
            'nomor_meja' => 'required',
            'kapasitas' => 'required|numeric',
            'status' => 'required|in:tersedia,terisi',
        ]);

        $meja = Meja::find($id_meja);
        if ($meja->update($request->all())) {
            return redirect()->route('meja')->with('success', 'Data meja berhasil diupdate');
        }
        return back()->with('pesan', 'Gagal mengupdate data meja');
    }

    public function destroy($id_meja)
    {
        try {
            $meja = Meja::find($id_meja);
            if (!$meja) {
                return back()->with('error', 'Menu tidak ditemukan');
            }

            if ($meja->delete()) {
                return redirect()->route('meja')->with('success', 'Data menu berhasil dihapus!');
            }
            return back()->with('error', 'Gagal menghapus data menu');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

}
