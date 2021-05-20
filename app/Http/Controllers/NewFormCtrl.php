<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PracticeCheckCtrl;
use App\Http\Requests\FormStatusRequest;
use App\Models\Form;
use App\Models\FormStatus;
use App\Models\Material;
use App\Models\Practician;
use App\Models\Tool;
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
    /*
        SELECT forms.id as id,
            forms.type as type,
            form_statuses.status as status,
            practicians.name as practician,
            laboratories.name as laboratory,
            form_statuses.created_at as submission,
            forms.practice_date as practice_date,
            forms.practice_start_time as practice_time
        FROM forms
        JOIN form_statuses ON forms.id = form_statuses.form_id
        JOIN practicians ON forms.id = practicians.form_id
        JOIN laboratories ON forms.laboratory_id = laboratories.id
        WHERE form_statuses.created_at IN (
            SELECT max(form_statuses.created_at) FROM form_statuses GROUP BY form_statuses.form_id
        )
        AND practicians.name IN (
            SELECT practicians.name FROM practicians WHERE practicians.type = 'leader' GROUP BY practicians.form_id
        )
        LIMIT 10

        select `forms`.`id` as `id`,
            `forms`.`type` as `type`,
            `form_statuses`.`status` as `status`,
            `practicians`.`name` as `practician`,
            `laboratories`.`name` as `laboratory`,
            `form_statuses`.`created_at` as `submission`,
            `forms`.`practice_date` as `practice_date`,
            `forms`.`practice_start_time` as `practice_time`
        from `forms`
        inner join `form_statuses` on `forms`.`id` = `form_statuses`.`form_id`
        inner join `practicians` on `forms`.`id` = `practicians`.`form_id`
        inner join `laboratories` on `forms`.`laboratory_id` = `laboratories`.`id`
        where `form_statuses`.`created_at` in
            (select *)
        and `practicians`.`name` in
            (select *)
        order by `form_statuses`.`created_at` asc
        limit 10

        select `forms`.`id` as `id`, `forms`.`type` as `type`, `form_statuses`.`status` as `status`, `practicians`.`name` as `practician`, `laboratories`.`name` as `laboratory`, `form_statuses`.`created_at` as `submission`, `forms`.`practice_date` as `practice_date`, `forms`.`practice_start_time` as `practice_time` from `forms` inner join `form_statuses` on `forms`.`id` = `form_statuses`.`form_id`
        inner join `practicians` on `forms`.`id` = `practicians`.`form_id`
        inner join `laboratories` on `forms`.`laboratory_id` = `laboratories`.`id`
        where `form_statuses`.`created_at` in
            (select *)
        and `practicians`.`name` in
            (select `practicians`.`name` where `practicians`.`type` = leader group by `forms`.`id`)
        order by `form_statuses`.`created_at` asc
        limit 10
    */

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

    public function print($id)
    {
        return app(PracticeCheckCtrl::class)->print($id);
    }

    public function preview(Request $request) {
        $id = explode('-', $request->id);
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

        return view('pages.admin.forms.preview-form', $data);
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

