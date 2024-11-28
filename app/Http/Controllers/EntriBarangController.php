<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class EntriBarangController extends Controller
{
    public function index() {
        if(auth()->guard('user')->user()->role != 'admin' && auth()->guard('user')->user()->role != 'waiter') {
            return redirect()->route('dashboard')->with('error', 'Anda tidak mempunyai permission untuk masuk ke halaman Barang!');
        }

        $data_barang = Menu::paginate(10);
        
        $last_barang = Menu::orderBy('id_menu', 'desc')->first();
        $next_number = $last_barang ? (int)substr($last_barang->id_menu, 3) + 1 : 1;
        
        $formatted_number = sprintf("MN-%03d", $next_number);

        return view('entriBarang', [
            'barangs' => $data_barang,
            'id_menu' => $formatted_number
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_menu' => 'required',
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
        ]);

        $last_barang = Menu::orderBy('id_menu', 'desc')->first();
        $next_number = $last_barang ? (int)substr($last_barang->id_menu, 3) + 1 : 1;
        $formatted_number = sprintf("MN-%03d", $next_number);

        try {
            $barang = new Menu();
            $barang->id_menu = $formatted_number;
            $barang->nama_menu = $request->nama_menu;
            $barang->harga = $request->harga;
            $barang->save();

            return redirect()->route('barang')->with('success', 'Data menu berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data menu: ' . $e->getMessage());
        }
    }

    public function edit_data($id_menu) 
    {
        $barang = Menu::find($id_menu);
        $data_barang = Menu::paginate(10);
        return view('entriBarang', [
            'barangs' => $data_barang,
            'edit' => $barang,
        ]);
    }

    public function update(Request $request, $id_menu) 
    {
        $request->validate([
            'id_menu' => 'required',
            'nama_menu' => 'required',
            'harga' => 'required|numeric',
        ]);

        $barang = Menu::find($id_menu);
        if ($barang->update($request->all())) {
            return redirect()->route('barang')->with('success', 'Data menu berhasil diupdate');
        }
        return back()->with('error', 'Gagal mengupdate data menu');
    }

    public function destroy($id_menu)
    {
        try {
            $barang = Menu::find($id_menu);
            if (!$barang) {
                return back()->with('error', 'Menu tidak ditemukan');
            }

            if ($barang->delete()) {
                return redirect()->route('barang')->with('success', 'Data menu berhasil dihapus!');
            }
            return back()->with('error', 'Gagal menghapus data menu');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
