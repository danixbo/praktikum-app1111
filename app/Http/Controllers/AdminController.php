<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login() {
        if(auth()->guard('user')->check()) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function cekUser(Request $request) {
        $request->validate([
            'username'=>'required',
            'password'=>'required',
        ], [
            'username.required' => 'Username harus diisi!',
            'password.required' => 'Password harus diisi!'
        ]);

        $data_user = $request->only(['username','password']);

        if(auth()->guard('user')->attempt($data_user)){
            $request->session()->regenerate();
            $user = auth()->guard('user')->user();
            $request->session()->put('user', $user);
            $request->session()->put('role', $user->role);
            return redirect('dashboard')->with('success', 'Berhasil login!');
        } else {
            if(!auth()->guard('user')->attempt(['username' => $request->username])) {
                session()->put('errors', collect(['username' => 'Username tidak ditemukan!']));
                return back()->withInput($request->only('username'));
            }
            session()->put('errors', collect(['password' => 'Password yang anda masukkan salah!']));
            return back()->withInput($request->only('username'));
        }
    }

    public function logout(Request $request) {
        auth()->guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', 'Berhasil logout');
    }

    public function dashboardAdmin() {
        if(!auth()->guard('user')->check()) {
            return redirect('/login');
        }
        return view('dashboard');
    }
}
