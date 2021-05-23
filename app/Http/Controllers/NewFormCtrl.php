<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormStatusRequest;
use App\Models\Form;
use App\Models\FormStatus;
use Illuminate\Http\Request;

class NewFormCtrl extends Controller
{
    public function countNewForm()
    {
        $data = Form::join('form_statuses', 'form_statuses.form_id', '=', 'forms.id')
            ->whereIn('form_statuses.created_at', function ($query) {
                $query->groupBy('forms.id')
                    ->selectRaw('max(form_statuses.created_at)')
                    ->from('form_statuses');
            })
            ->where('form_statuses.status', 'submitted')
            ->select(['forms.id', 'form_statuses.status'])
            ->get();
        return response($data)->header('Content-Type', 'application/json');
    }

    public function index()
    {
        return view('pages.admin.forms.new-form');
    }

    public function newForm()
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
            ->where('form_statuses.status', 'submitted')
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

        return response($form)->header('Content-Type', 'application/json');
    }

    public function acc(Request $request)
    {
        $id = explode('-', $request->id);

        $formStatus = new FormStatus();
        $formStatus->form_id = $id[1];
        $formStatus->status = 'accepted';
        $formStatus->message = NULL;
        return ['accepted' => $formStatus->save()];
    }

    public function reject(FormStatusRequest $request)
    {
        $data = (object) $request->validated();
        $id = explode('-', $data->id);

        $formStatus = new FormStatus();
        $formStatus->form_id = $id[1];
        $formStatus->status = 'rejected';
        $formStatus->message = $data->message;
        return ['rejected' => $formStatus->save()];
    }
}

