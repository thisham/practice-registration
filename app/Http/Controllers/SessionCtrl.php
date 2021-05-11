<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionCtrl extends Controller
{
    public function create(LoginRequest $request)
    {
        $data = $request->validated();

        Auth::attempt($data);

        if (Auth::check()) 
            return redirect()->route('home');
        
        $request->session()->flash('msgfailed', 'Kombinasi email dan password tidak ditemukan.');
        return redirect()->route('login');
    }

    public function store(RegisterRequest $request)
    {
        $data = (object) $request->validated();

        $user = new User();
        $user->name = $data->name;
        $user->email = $data->email;
        $user->password = Hash::make($data->password);
        $isSaved = $user->save();

        if ($isSaved) {
            $request->session()->flash('msgsuccess', 'Akun baru berhasil dibuat. Silakan login menggunakan akun tersebut.');
            return redirect()->route('login');
        }

        $request->session()->flash('msgfailed', 'Akun baru gagal dibuat.');
        return redirect()->route('register')->withInput((array) $data);
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->flash('msgsuccess', 'Berhasil keluar dari sistem.');
        return redirect()->route('login');
    }
}
