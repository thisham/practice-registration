<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormStatus;
use Illuminate\Http\Request;

class NewFormCtrl extends Controller
{
    public function countNewForm()
    {
        // SELECT forms.id as form_id, form_statuses.status as status 
        // FROM forms 
        // JOIN form_statuses ON forms.id = form_statuses.form_id 
        // WHERE form_statuses.created_at 
        // IN (SELECT max(form_statuses.created_at) GROUP BY forms.id)
        // AND form_statuses.status = 'accepted' 
        $data = Form::join('form_statuses', 'form_statuses.form_id', '=', 'forms.id')
            ->whereIn('form_statuses.created_at', function ($query) {
                $query->groupBy('forms.id')
                    ->selectRaw('max(form_statuses.created_at)');
            })
            ->where('form_statuses.status', 'submitted')
            ->select(['forms.id', 'form_statuses.status'])
            ->get();
        return response($data)->header('Content-Type', 'application/json');
    }
}
