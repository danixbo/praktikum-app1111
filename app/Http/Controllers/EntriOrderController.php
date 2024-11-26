<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;

class EntriOrderController extends Controller
{
    public function index() {
        if(auth()->guard('user')->user()->role != 'waiter') {
            return redirect('/dashboard')->with('error', 'Anda tidak mempunyai permission untuk masuk ke halaman Order!');
        }
        $orders = Pesanan::all();
        return view('entriOrder', compact('orders'));
    }
}
