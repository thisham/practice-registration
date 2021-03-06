<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeAndPlaceRequest;
use App\Models\Course;
use App\Models\Form;
use App\Models\FormStatus;
use App\Models\Laboratory;
use App\Models\Material;
use App\Models\Practician;
use App\Models\Tool;
use App\Models\ToolClassification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PracticeRegistrationCtrl extends Controller
{
    public function index()
    {
        return view('pages.registration.home');
    }

    public function timeAndPlace(Request $request)
    {
        $data = [
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get(),
            'courses' => Course::where('is_active', 1)->select('id', 'code', 'name', 'type')->get()
        ];

        return view('pages.registration.time-and-place', $data);
    }

    public function timeAndPlaceResponse(TimeAndPlaceRequest $request)
    {
        $data = (object) $request->validated();
        $course = Course::find($data->course);

        if ($course->type == 'REG')
            return redirect()->route('register-fill-reg-practice-data')
                ->with('practice', $data);

        if ($course->type == 'KTI')
            return redirect()->route('register-fill-kti-practice-data')
                ->with('practice', $data);

        if ($course->type == 'EXT')
            return redirect()->route('register-fill-ext-practice-data')
                ->with('practice', $data);
    }

    public function fillKTIFormData(Request $request)
    {
        if (!Session::has('practice'))
            return redirect()->route('register-set-time-and-place')
                ->with('msgfailed', 'Sebelum mengisi form, Anda harus mengisi informasi di bawah ini.');

        $data = [
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get(),
            'courses' => Course::all(['id', 'code', 'name', 'type', 'curriculum']),
            'cs' => Course::find(Session::get('practice')->course),
            'tools' => ToolClassification::all(['id', 'name', 'size', 'amount']),
            'practice' => (object) Session::get('practice'),
        ];

        return view('pages.registration.kti-form', $data);
    }

    public function fillEXTFormData(Request $request)
    {
        if (!Session::has('practice'))
            return redirect()->route('register-set-time-and-place')
                ->with('msgfailed', 'Sebelum mengisi form, Anda harus mengisi informasi di bawah ini.');

        $data = [
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get(),
            'courses' => Course::all(['id', 'code', 'name', 'type', 'curriculum']),
            'cs' => Course::find(Session::get('practice')->course),
            'tools' => ToolClassification::all(['id', 'name', 'size', 'amount']),
            'practice' => (object) Session::get('practice'),
        ];

        return view('pages.registration.ext-form', $data);
    }

    public function fillREGFormData(Request $request)
    {
        if (!Session::has('practice'))
            return redirect()->route('register-set-time-and-place')
                ->with('msgfailed', 'Sebelum mengisi form, Anda harus mengisi informasi di bawah ini.');

        $data = [
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get(),
            'courses' => Course::all(['id', 'code', 'name', 'type', 'curriculum']),
            'cs' => Course::find(Session::get('practice')->course),
            'tools' => ToolClassification::all(['id', 'name', 'size', 'amount']),
            'practice' => (object) Session::get('practice'),
        ];

        return view('pages.registration.reg-form', $data);
    }

    public function storeForm(Request $request)
    {
        $course = Course::find($request->course);
        $practicians = ($course->type === 'REG') 
            ? $request->practicians 
            : 1 + (count($request->practician_member_name ?? []));
        
        $form = new Form();
        $form->type = $course->type;
        $form->laboratory_id = $request->laboratory;
        $form->course_id = $request->course;
        $form->institution = $request->institution ?? 'Akademi Farmasi Mitra Sehat Mandiri Sidoarjo';
        $form->theme = $request->theme ?? NULL;
        $form->practicians = $practicians;
        $form->lecturer = $request->lecturer;
        $form->is_reportable = false;
        $form->practice_date = $request->date;
        $form->practice_start_time = $request->time;
        $isFormSaved = $form->save();
        
        $practician = new Practician();
        $practician->name = $request->name;
        $practician->id_number = $request->id_number;
        $practician->email = $request->email;
        $practician->phone = $request->phone;
        $practician->type = 'leader';
        $practician->form_id = $form->id;
        $practician->save();
        
        if ($practicians > 1 && $course->type != 'REG') {
            for ($i = 0; $i < $practicians - 1; $i++) {
                $practician = new Practician();
                $practician->name = $request->practician_member_name[$i];
                $practician->id_number = $request->practician_member_id_number[$i];
                $practician->phone = $request->practician_member_phone[$i];
                $practician->type = 'member';
                $practician->form_id = $form->id;
                $practician->save();
            }
        }

        if (isset($request->tool_name)) {
            for ($i = 0; $i < count($request->tool_name); $i++) {
                $tool_data = ToolClassification::find($request->tool_name[$i]);
                $tool = new Tool();
                $tool->form_id = $form->id;
                $tool->name = $tool_data->name;
                $tool->size = $tool_data->size;
                $tool->class = $tool_data->class;
                $tool->quantity = $request->tool_quantity[$i];
                $tool->save();
            }
        }

        if (isset($request->material_name)) {
            for ($i = 0; $i < count($request->material_name); $i++) {
                $material = new Material();
                $material->form_id = $form->id;
                $material->name = $request->material_name[$i];
                $material->quantity = $request->material_quantity[$i];
                $material->status = $request->material_status[$i];
                $material->save();
            }
        }

        $status = new FormStatus();
        $status->form_id = $form->id;
        $status->status = 'submitted';
        $status->message = NULL;
        $status->save();

        $form_id = sprintf('%s-%s', $form->type, $form->id);

        if ($isFormSaved)
            return redirect()->route('register-get-practice-ticket', ['id' => $form_id]);
        
        return redirect()->route('register-set-time-and-place')
            ->with('msgfailed', 'Form tidak tersimpan. Mohon ulangi lagi atau hubungi petugas.');
    }

    public function practiceTicket($id)
    {
        $id = explode('-', $id);
        $form = Form::where('id', $id[1])->with(['laboratory', 'course'])->first();

        if (!$form) 
            return redirect()->route('register-set-time-and-place')
                ->with('msgfailed', 'Form tidak ditemukan. Harap melakukan pengajuan terlebih dahulu.');

        $data = [
            'form' => $form,
            'leader' => Practician::where([['form_id', $id[1]], ['type', 'leader']])->first(),
            'members' => Practician::where([['form_id', $id[1]], ['type', 'member']])->get(),
            'materials' => Material::where('form_id', $id[1])->get(),
            'tools' => Tool::where('form_id', $id[1])->get(),
            'laboratory' => $form->laboratory()->first(),
            'course' => $form->course()->first()
        ];

        return view('pages.registration.summary', $data);
    }
}
