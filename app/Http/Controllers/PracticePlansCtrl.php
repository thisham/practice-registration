<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormStatus;
use App\Models\Material;
use App\Models\Practician;
use App\Models\Tool;
use App\Models\ToolClassification;
use Illuminate\Http\Request;

class PracticePlansCtrl extends Controller
{
    public function index()
    {
        return view('pages.admin.forms.planned.all');
    }

    public function allPlans()
    {
        $form = Form::join('form_statuses', 'forms.id', '=', 'form_statuses.form_id')
            ->join('practicians', 'forms.id', '=', 'practicians.form_id')
            ->join('laboratories', 'forms.laboratory_id', '=', 'laboratories.id')
            ->whereIn('form_statuses.created_at', function ($query) {
                $query->groupBy('form_statuses.form_id')
                    ->selectRaw('max(form_statuses.created_at)')
                    ->from('form_statuses');
            })
            ->whereIn('practicians.name', function ($query) {
                $query->groupBy('practician.form_id')
                    ->where('practicians.type', 'leader')
                    ->select('practicians.name')
                    ->from('practicians');
            })
            ->where('form_statuses.status', 'accepted')
            ->select([
                'forms.id as id',
                'forms.type as type',
                'form_statuses.status as status',
                'practicians.name as practician',
                'laboratories.name as laboratory',
                'form_statuses.created_at as submission',
                'forms.practice_date as practice_date',
                'forms.practice_start_time as practice_time'
            ])
            ->limit(10)
            ->get();

        return response($form ?? [])->header('Content-Type', 'application/json');
    }
    
    public function adjust(Request $request)
    {
        $id = explode('-', $request->id);
        $form = Form::where([['id', $id[1]], ['type', $id[0]]])->with(['laboratory', 'course'])->first();

        $data = [
            'form' => $form,
            'leader' => Practician::where([['form_id', $id[1]], ['email', '!=', NULL]])->first(),
            'members' => Practician::where([['form_id', $id[1]], ['email', '=', NULL]])->get(),
            'materials' => Material::where('form_id', $id[1])->get(),
            'tools' => Tool::where('form_id', $id[1])->get(),
            'tool_classifications' => ToolClassification::all(),
            'laboratory' => $form->laboratory()->first(),
            'course' => $form->course()->first(),
            'statuses' => FormStatus::where('form_id', $id[1])->get()
        ];

        return view('pages.admin.forms.planned.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $id = explode('-', $request->id);
        
        $form = Form::find($id[1]);
        $form->is_reportable = true;
        $isFormSaved = $form->save();

        if (isset($request->tool_id)) {
            for ($i = 0; $i < count($request->tool_id); $i++) {
                $tool = Tool::find($request->tool_id[$i]);
                $tool->quantity = $request->tool_quant[$i];
                $tool->save();
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

        Material::where('form_id', $id[1])->delete();

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
        $status->status = 'done';
        $status->message = NULL;
        $status->save();

        if ($isFormSaved)
            return redirect()->route('admin-practice-plans')
                ->with('msgsuccess', 'Form telah disimpan di histori praktikum dan sudah dapat direkapitulasi!');
        
        return redirect()->route('register-set-time-and-place')
            ->with('msgfailed', 'Form tidak tersimpan. Mohon ulangi lagi atau hubungi petugas.');
    }

    public function cancel(Request $request)
    {
        $id = explode('-', $request->id);
        $status = new FormStatus();
        $status->form_id = $id[1];
        $status->status = 'done';
        $status->message = NULL;
        return ['cancelled' => $status->save()];
    }
}
