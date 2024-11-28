<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index() {
        if(auth()->guard('user')->user()->role != 'admin' && auth()->guard('user')->user()->role != 'kasir' && auth()->guard('user')->user()->role != 'waiter') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak mempunyai permission untuk masuk ke halaman Pelanggan!');
        }
        
        $data_pelanggan = Pelanggan::paginate(10);
        
        $last_pelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->first();
        $next_number = $last_pelanggan ? (int)substr($last_pelanggan->id_pelanggan, 3) + 1 : 1;
        
        $formatted_number = sprintf("PL-%03d", $next_number);

        return view('pelanggan', [
            'pelanggans' => $data_pelanggan,
            'id_pelanggan' => $formatted_number
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required',
            'nama_Pelanggan' => 'required',
            'jenis_Kelamin' => 'required|in:laki-laki,perempuan',
            'no_hp' => 'required|max:13',
            'alamat' => 'required',
        ]);

        try {
            $last_pelanggan = Pelanggan::orderBy('id_pelanggan', 'desc')->first();
            $next_number = $last_pelanggan ? (int)substr($last_pelanggan->id_pelanggan, 3) + 1 : 1;
            $formatted_number = sprintf("PL-%03d", $next_number);
            
            $pelanggan = new Pelanggan();
            $pelanggan->id_pelanggan = $request->id_pelanggan;
            $pelanggan->nama_Pelanggan = $request->nama_Pelanggan;
            $pelanggan->jenis_Kelamin = $request->jenis_Kelamin;
            $pelanggan->no_hp = $request->no_hp;
            $pelanggan->alamat = $request->alamat;
            $pelanggan->save();

            return redirect()->route('pelanggan')->with('success', 'Data pelanggan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function edit_data($id_pelanggan) 
    {
        $pelanggan = Pelanggan::find($id_pelanggan);
        $data_pelanggan = Pelanggan::paginate(10);
        return view('pelanggan', [
            'pelanggans' => $data_pelanggan,
            'edit' => $pelanggan,
        ]);
    }

    public function update(Request $request, $id_pelanggan) 
    {
        $request->validate([
            'nama_Pelanggan' => 'required',
            'jenis_Kelamin' => 'required|in:laki-laki,perempuan',
            'no_hp' => 'required|max:13',
            'alamat' => 'required',
        ]);

        try {

            $pelanggan = Pelanggan::find($id_pelanggan);
            $pelanggan->nama_Pelanggan = $request->nama_Pelanggan;
            $pelanggan->jenis_Kelamin = $request->jenis_Kelamin;
            $pelanggan->no_hp = $request->no_hp;
            $pelanggan->alamat = $request->alamat;
            $pelanggan->save();

            return redirect()->route('pelanggan')->with('success', 'Data pelanggan berhasil diupdate');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengupdate data: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id_pelanggan)
    {
        try {
            $pelanggan = Pelanggan::find($id_pelanggan);
            if (!$pelanggan) {
                return back()->with('error', 'Pelanggan tidak ditemukan');
            }

            if ($pelanggan->delete()) {
                return redirect()->route('pelanggan')->with('success', 'Data pelanggan berhasil dihapus!');
            }
            return back()->with('error', 'Gagal menghapus data pelanggan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
