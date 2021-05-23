<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormStatus;
use App\Models\Material;
use App\Models\Practician;
use App\Models\Tool;
use Illuminate\Http\Request;

class FormActionCtrl extends Controller
{
    public function preview(Request $request) {
        $id = explode('-', $request->id);
        $form = Form::where([['id', $id[1]], ['type', $id[0]]])->with(['laboratory', 'course'])->first();

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

        return view('pages.admin.forms.preview-form', $data);
    }

    public function print($id)
    {
        $id = explode('-', $id);
        $form = Form::where('id', $id[1])->with(['laboratory', 'course'])->first();

        $data = [
            'form' => $form,
            'leader' => Practician::where([['form_id', $id[1]], ['type', 'leader']])->first(),
            'members' => Practician::where([['form_id', $id[1]], ['type', 'member']])->get(),
            'materials' => Material::where('form_id', $id[1])->get(),
            'tools' => Tool::where('form_id', $id[1])->get(),
            'laboratory' => $form->laboratory()->first(),
            'course' => $form->course()->first(),
            'status' => FormStatus::where('form_id', $id[1])->orderBy('created_at', 'DESC')->first()
        ];

        return view('pages.print.form', $data);
        // return PDF::loadView('pages.print.form', $data)->setPaper('a4')->stream(sprintf('Form Registrasi Praktikum %s-%s.pdf', $id[0], $id[1]));
        // return $pdf->download();
    }
}
