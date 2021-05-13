<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToolClassificationInputRequest;
use App\Models\ToolClassification;
use Illuminate\Http\Request;

class ToolClassificationCtrl extends Controller
{
    public function index()
    {
        $data = [
            'tools' => ToolClassification::all()
        ];

        return view('pages.admin.tool-classifications.all', $data);
    }

    public function create()
    {
        return view('pages.admin.tool-classifications.add');
    }

    public function store(ToolClassificationInputRequest $request)
    {
        $data = (object) $request->validated();
        $tool = new ToolClassification();
        $tool->name = $data->name;
        $tool->size = $data->size ?? NULL;
        $tool->class = $data->class;
        $tool->amount = $data->amount;
        $isSaved = $tool->save();

        if ($isSaved) {
            $request->session()->flash('msgsuccess', 'Data klasifikasi alat berhasil ditambahkan.');
            return redirect()->route('admin-manage-tools');
        }

        $request->session()->flash('msgfailed', 'Data klasifikasi alat gagal ditambahkan.');
        return redirect()->route('admin-add-tool')->withInput();
    }

    public function show($id)
    {
        $data = [
            'tool' => ToolClassification::find($id)
        ];

        return view('pages.admin.tool-classifications.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'tool' => ToolClassification::find($id)
        ];

        return view('pages.admin.tool-classifications.edit', $data);
    }

    public function update(ToolClassificationInputRequest $request, $id)
    {
        $data = (object) $request->validated();
        $tool = ToolClassification::find($id);
        $tool->name = $data->name;
        $tool->size = $data->size;
        $tool->class = $data->class;
        $tool->amount = $data->amount;
        $isSaved = $tool->save();

        if ($isSaved) {
            $request->session()->flash('msgsuccess', 'Data klasifikasi alat berhasil diperbarui.');
            return redirect()->route('admin-manage-tools');
        }

        $request->session()->flash('msgfailed', 'Data klasifikasi alat gagal diperbarui.');
        return redirect()->route('admin-add-tool')->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $isDeleted = ToolClassification::find($id)->delete();

        if ($isDeleted) {
            $request->session()->flash('msgsuccess', 'Data klasifikasi alat berhasil ditambahkan.');
            return redirect()->route('admin-manage-tools');
        }

        $request->session()->flash('msgfailed', 'Data klasifikasi alat gagal ditambahkan.');
        return redirect()->route('admin-add-tool')->withInput();
    }
}
