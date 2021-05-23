<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingCheckRequest;
use App\Models\Form;
use App\Models\FormStatus;
use App\Models\Material;
use App\Models\Practician;
use App\Models\Tool;
use Illuminate\Http\Request;

class PracticeCheckCtrl extends Controller
{
    public function index()
    {
        return view('pages.booking-check.search');
    }

    public function show(BookingCheckRequest $request)
    {
        $data = (object) $request->validated();
        $id = explode('-', $data->code);
        $form = Form::where([['id', $id[1]], ['type', $id[0]]])->with(['laboratory', 'course'])->first();

        if (!$form) 
            return redirect()->route('check-registration')
                ->with('msgfailed', 'Form tidak ditemukan. Harap melakukan pengajuan terlebih dahulu.');

        $data = [
            'form' => $form,
            'leader' => Practician::where([['form_id', $id[1]], ['email', '!=', NULL]])->first(),
            'members' => Practician::where([['form_id', $id[1]], ['email', '=', NULL]])->get(),
            'materials' => Material::where('form_id', $id[1])->get(),
            'tools' => Tool::where('form_id', $id[1])->get(),
            'laboratory' => $form->laboratory()->first(),
            'course' => $form->course()->first(),
            'statuses' => FormStatus::where('form_id', $id[1])->get()
        ];

        return view('pages.booking-check.result', $data);
    }

    public function print($id)
    {
        return app(FormActionCtrl::class)->print($id);
    }
}
