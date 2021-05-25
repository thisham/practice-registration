<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountInfoChangeRequest;
use App\Http\Requests\PasswordChangeRequest;
use App\Models\Form;
use App\Models\Laboratory;
use App\Models\ToolClassification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserCtrl extends Controller
{
    public function index()
    {
        $data = [
            'form_all' => Form::all()->count(),
            'form_history' => Form::where('is_reportable', 1)->get()->count(),
            'tools_count' => ToolClassification::sum('amount'),
            'labs_count' => Laboratory::all()->count()
        ];

        return view('pages.admin.home', $data);
    }

    public function infoEdit()
    {
        $data = [
            'user' => User::find(auth()->user()->id)
        ];

        return view('pages.admin.account.user-data', $data);
    }

    public function infoUpdate(AccountInfoChangeRequest $request)
    {
        $data = (object) $request->validated();
        $user = User::find(auth()->user()->id);

        $user->name = $data->name;
        $user->email = $data->email;
        $isSaved = $user->save();
        
        if ($isSaved)
            return redirect()->route('admin-change-account-info')
                ->with('msgsuccess', 'Pengubahan data akun berhasil!');
                
        return redirect()->route('admin-change-account-info')
            ->with('msgsuccess', 'Pengubahan data akun berhasil!');
    }

    public function passwordEdit()
    {
        return view('pages.admin.account.password');
    }

    public function passwordUpdate(PasswordChangeRequest $request)
    {
        $data = (object) $request->validated();
        $user = User::find(auth()->user()->id);
        
        if (Hash::check($data->oldpassword, $user->password)) {
            $user->password = Hash::make($data->newpassword);
            $isSaved = $user->save();

            if ($isSaved) 
                return redirect()->route('admin-change-account-password')
                    ->with('msgsuccess', 'Pengubahan password berhasil!');
        }

        return redirect()->route('admin-change-account-password')
            ->with('msgfailed', 'Pengubahan password gagal!');
    }
}
