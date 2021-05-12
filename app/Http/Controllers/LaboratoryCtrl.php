<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaboratoryInputRequest;
use App\Models\Laboratory;
use Illuminate\Http\Request;

class LaboratoryCtrl extends Controller
{
    public function index()
    {
        $data = [
            'laboratories' => Laboratory::all()
        ];

        return view('pages.admin.laboratory.all', $data);
    }

    public function create()
    {
        return view('pages.admin.laboratory.add');
    }

    public function store(LaboratoryInputRequest $request)
    {
        $data = (object) $request->validated();
        $laboratory = new Laboratory();
        $laboratory->name = $data->name;
        $laboratory->location = $data->location;
        $isSaved = $laboratory->save();

        if ($isSaved) {
            $request->session()->flash('msgsuccess', 'Data laboratorium berhasil ditambahkan.');
            return redirect()->route('admin-manage-laboratories');
        }

        $request->session()->flash('msgfailed', 'Data laboratorium tidak dapat ditambahkan.');
        return redirect()->route('admin-add-laboratory')->withInput();
    }

    public function show($id)
    {
        $data = [
            'laboratory' => Laboratory::find($id)
        ];

        return view('pages.admin.laboratory.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'laboratory' => Laboratory::find($id)
        ];

        return view('pages.admin.laboratory.edit', $data);
    }

    public function update(LaboratoryInputRequest $request, $id)
    {
        $data = (object) $request->validated();
        $laboratory = Laboratory::find($id);
        $laboratory->name = $data->name;
        $laboratory->location = $data->location;
        $isSaved = $laboratory->save();

        if ($isSaved) {
            $request->session()->flash('msgsuccess', 'Data laboratorium berhasil diperbarui.');
            return redirect()->route('admin-manage-laboratories');
        }

        $request->session()->flash('msgfailed', 'Data laboratorium tidak dapat diperbarui.');
        return redirect()->route('admin-edit-laboratory')->withInput();
    }

    public function destroy(Request $request, $id)
    {
        $isDeleted = Laboratory::find($id)->delete();

        if ($isDeleted) {
            $request->session()->flash('msgsuccess', 'Data laboratorium berhasil dihapus.');
            return redirect()->route('admin-manage-laboratories');
        }

        $request->session()->flash('msgfailed', 'Data laboratorium tidak dapat dihapus.');
        return redirect()->route('admin-manage-laboratories');
    }
}
