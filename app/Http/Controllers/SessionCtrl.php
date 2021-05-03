<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionCtrl extends Controller
{
    public function create()
    {
        return view('pages.login');
    }

    public function store(LoginRequest $request)
    {
        $data = $request->validated();

        Auth::attempt($data);

        if (Auth::check()) 
            return redirect()->route('home');
        
        $request->session()->flash('msgfailed', 'Kombinasi email dan password tidak ditemukan.');
        return redirect()->route('login');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->flash('msgsuccess', 'Berhasil keluar dari sistem.');
        return redirect()->route('login');
    }
}
