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
        $barangs = Menu::all();
        return view('entriBarang', compact('barangs'));
    }
}
