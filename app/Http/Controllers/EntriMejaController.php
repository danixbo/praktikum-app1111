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

    public function tambah_data(Request $request) {
        $request->validate([
            'nomor_meja' => 'required',
            'kapasitas' => 'required|numeric',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        Meja::create($request->all());

        return redirect()->route('meja')->with('success', 'Data Meja berhasil ditambahkan!');
    }

    public function edit_data($id_meja) {
        $meja = Meja::find($id_meja);
        $data_meja = Meja::paginate(10);
        return view('entriMeja', [
            'mejas' => $data_meja,
            'edit' => $meja,
        ]);
    }

    public function update_date(Request $request, $id_meja) {
        $request->validate([
            'nomor_meja' => 'required',
            'kapasitas' => 'required|numeric',
            'status' => 'required|in:tersedia,tidak tersedia',
        ]);

        $meja = Meja::find($id_meja);
        $validatedData = $request->all();
        $validatedData['status'] = $validatedData['status'] == 'tidak tersedia' ? 'tidak tersedia' : 'tersedia'; // Normalize the status to ensure it matches the CHECK constraint
        $validatedData['status'] = $validatedData['status'] == 'tidak tersedia' ? 'tidak tersedia' : 'tersedia'; // Ensure the status is correctly formatted for the CHECK constraint
        if ($meja->update($validatedData)) {
            return redirect()->route('meja')->with('success', 'Data meja berhasil diupdate');
        }
        return back()->with('pesan', 'Gagal mengupdate data meja');
    }

}
