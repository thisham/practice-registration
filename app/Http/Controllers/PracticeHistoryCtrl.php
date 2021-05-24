<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class PracticeHistoryCtrl extends Controller
{
    public function index()
    {
        return view('pages.admin.forms.done');
    }

    public function allPractices()
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
            ->where('form_statuses.status', 'done')
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
}
