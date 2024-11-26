<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
class EntriTransaksiController extends Controller
{
    public function index() {
        if(auth()->guard('user')->user()->role != 'kasir') {
            return redirect('/dashboard')->with('error', 'Anda tidak mempunyai permission untuk masuk ke halaman Transaksi!');
        }
        $transaksis = Transaksi::all();
        return view('entriTransaksi', compact('transaksis'));
    }
}
