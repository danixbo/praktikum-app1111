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
            'nama_pelanggan' => $request->status == 'terisi' ? 'required' : 'nullable',
            'jumlah_pelanggan' => $request->status == 'terisi' ? "required|numeric|max:{$request->kapasitas}" : 'nullable',
        ], [
            'jumlah_pelanggan.max' => 'Jumlah pelanggan tidak boleh melebihi kapasitas meja (:max orang)'
        ]);

        try {
            $last_meja = Meja::orderBy('nomor_meja', 'desc')->first();
            $next_number = $last_meja ? (int)substr($last_meja->nomor_meja, 2) + 1 : 1;
            $formatted_number = sprintf("M-%03d", $next_number);
            
            $meja = new Meja();
            $meja->nomor_meja = $request->nomor_meja;
            $meja->kapasitas = $request->kapasitas;
            $meja->status = $request->status;
            
            // Hanya set nama_pelanggan dan jumlah_pelanggan jika status terisi
            if ($request->status == 'terisi') {
                $meja->nama_pelanggan = $request->nama_pelanggan;
                $meja->jumlah_pelanggan = $request->jumlah_pelanggan;
            }

            $meja->save();
            return redirect()->route('meja')->with('success', 'Data meja berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data meja: ' . $e->getMessage());
        }
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
            'nama_pelanggan' => $request->status == 'terisi' ? 'required' : 'nullable',
            'jumlah_pelanggan' => $request->status == 'terisi' ? "required|numeric|max:{$request->kapasitas}" : 'nullable',
        ], [
            'jumlah_pelanggan.max' => 'Jumlah pelanggan tidak boleh melebihi kapasitas meja (:max orang)'
        ]);

        $meja = Meja::find($id_meja);
        
        // Reset nama_pelanggan dan jumlah_pelanggan jika status tersedia
        if ($request->status == 'tersedia') {
            $request->merge([
                'nama_pelanggan' => null,
                'jumlah_pelanggan' => null
            ]);
        }

        if ($meja->update($request->all())) {
            return redirect()->route('meja')->with('success', 'Data meja berhasil diupdate');
        }
        return back()->with('error', 'Gagal mengupdate data meja');
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
