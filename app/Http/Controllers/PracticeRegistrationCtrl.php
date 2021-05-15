<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimeAndPlaceRequest;
use App\Models\Form;
use App\Models\Laboratory;
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
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get()
        ];

        return view('pages.registration.time-and-place', $data);
    }

    public function timeAndPlaceResponse(TimeAndPlaceRequest $request)
    {
        $data = (object) $request->validated();

        if ($data->type == 'REG')
            return redirect()->route('register-fill-reg-practice-data')
                ->with('practice', $data);

        if ($data->type == 'KTI')
            return redirect()->route('register-fill-kti-practice-data')
                ->with('practice', $data);

        if ($data->type == 'EXT')
            return redirect()->route('register-fill-ext-practice-data')
                ->with('practice', $data);
    }

    public function testNewFunction(Request $request)
    {
        $data = [
            'tools' => ToolClassification::all(['id', 'name', 'size', 'amount']),
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get()
        ];

        return view('pages.test', $data);
    }

    public function fillKTIFormData(Request $request)
    {
        if (!Session::has('practice'))
            return redirect()->route('register-set-time-and-place')
                ->with('msgfailed', 'Sebelum mengisi form, Anda harus mengisi informasi di bawah ini.');

        $data = [
            'practice' => (object) Session::get('practice'),
            'tools' => ToolClassification::all(),
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get()
        ];

        return view('pages.registration.kti-form', $data);
    }

    public function fillEXTFormData(Request $request)
    {
        if (!Session::has('practice'))
            return redirect()->route('register-set-time-and-place')
                ->with('msgfailed', 'Sebelum mengisi form, Anda harus mengisi informasi di bawah ini.');

        $data = [
            'practice' => (object) Session::get('practice'),
            'tools' => ToolClassification::all(['id', 'name', 'size', 'amount']),
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get()
        ];

        return view('pages.registration.ext-form', $data);
    }

    public function fillREGFormData(Request $request)
    {
        if (!Session::has('practice'))
            return redirect()->route('register-set-time-and-place')
                ->with('msgfailed', 'Sebelum mengisi form, Anda harus mengisi informasi di bawah ini.');

        $data = [
            'practice' => (object) Session::get('practice'),
            'tools' => ToolClassification::all(['id', 'name', 'size', 'amount']),
            'laboratories' => Laboratory::where('is_active', 1)->select('id', 'name')->get()
        ];

        return view('pages.registration.reg-form', $data);
    }

    private function formSummary(Request $request)
    {
        # code...
    }

    public function summaryKTIFormData(Request $request)
    {
        dd($request->all());
    }

    public function summaryEXTFormData(Request $request)
    {
        # code...
    }

    public function summaryREGFormData(Request $request)
    {
        # code...
    }

    public function storeKTIForm(Request $request)
    {
        // $laboratory = Laboratory::find($request->laboratory);
        // $form = new Form();
        dd($request->all());
    }

    public function storeEXTForm(Request $request)
    {
        # code...
    }

    public function storeREGForm(Request $request)
    {
        # code...
    }

    public function practiceTicket(Request $request)
    {
        # code...
    }
}
