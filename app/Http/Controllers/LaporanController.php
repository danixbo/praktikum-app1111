<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        $userRoles = ['owner', 'kasir', 'waiter'];
        if(!in_array(auth()->guard('user')->user()->role, $userRoles, true)) {
            return redirect('/dashboard')->with('error', 'Anda tidak mempunyai permission untuk masuk ke halaman Barang!');
        }
        return view('generateLaporan');
    }
}
