<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Laboratory;
use App\Models\ToolClassification;
use Illuminate\Http\Request;

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
}
