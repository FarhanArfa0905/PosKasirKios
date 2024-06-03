<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    //
    public function index() 
    {
        return view('/admin.auth.login');
    }

    public function doLogin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            Alert::success('Berhasil Login', 'Selamat Datang Admin Ganteng');
            return redirect('/admin/dashboard');
        }

        return back()->with('LoginError','Email Atau Password Salah');
    }

    public function logout()
    {
        Auth::logout();
        Request()->session()->invalidate();
        Request()->session()->regenerateToken();
        // Alert::success('Berhasil Logout', 'Bai Bai Sugoiii');
        return redirect('/login');
    }

}
