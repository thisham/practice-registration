<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormStatus;
use Illuminate\Http\Request;

class PracticeRejectedCtrl extends Controller
{
    public function index()
    {
        return view('pages.admin.forms.rejected');
    }

    public function allPlans(Request $request)
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
            ->where('form_statuses.status', 'rejected')
            ->where('forms.practice_date', $request->date)
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
            ->get();

        return response($form ?? [])->header('Content-Type', 'application/json');
    }

    public function acc(Request $request)
    {
        $id = explode('-', $request->id);
        $status = new FormStatus();
        $status->form_id = $id[1];
        $status->status = 'accepted';
        $status->message = NULL;
        return ['accepted' => $status->save()];
    }
}
