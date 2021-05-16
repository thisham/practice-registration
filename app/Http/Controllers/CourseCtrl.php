<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseInputRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseCtrl extends Controller
{
    public function index()
    {
        $data = [
            'courses' => Course::all(['id', 'code' ,'name', 'is_active'])
        ];

        return view('pages.admin.courses.all', $data);
    }

    public function create()
    {
        return view('pages.admin.courses.add');
    }

    public function store(CourseInputRequest $request)
    {
        $data = (object) $request->validated();
        $course = new Course();
        $course->code = $data->code;
        $course->name = $data->name;
        $course->type = $data->type;
        $course->curriculum = $data->curriculum;
        $course->is_active = isset($data->is_active);
        $isSaved = $course->save();

        if ($isSaved) 
            return redirect()->route('admin-manage-courses')
                ->with('msgsuccess', 'Mata kuliah berhasil ditambahkan.');
        
        return redirect()->route('admin-manage-courses')
            ->with('msgfailed', 'Mata kuliah tidak berhasil disimpan.');
    }

    public function show($id)
    {
        $data = [
            'course' => Course::find($id)
        ];

        return view('pages.admin.courses.show', $data);
    }

    public function edit($id)
    {
        $data = [
            'course' => Course::find($id)
        ];

        return view('pages.admin.courses.edit', $data);
    }

    public function update(CourseInputRequest $request, $id)
    {
        $data = (object) $request->validated();
        $course = Course::find($id);
        $course->code = $data->code;
        $course->name = $data->name;
        $course->type = $data->type;
        $course->curriculum = $data->curriculum;
        $course->is_active = isset($data->is_active);
        $isSaved = $course->save();

        if ($isSaved) 
            return redirect()->route('admin-manage-courses')
                ->with('msgsuccess', 'Mata kuliah berhasil diperbarui.');
        
        return redirect()->route('admin-manage-courses')
            ->with('msgfailed', 'Perubahan data mata kuliah tidak berhasil disimpan.');
    }

    public function destroy($id)
    {
        $isDeleted = Course::find($id)->delete();

        if ($isDeleted) 
            return redirect()->route('admin-manage-courses')
                ->with('msgsuccess', 'Mata kuliah berhasil dihapus.');
        
        return redirect()->route('admin-manage-courses')
            ->with('msgfailed', 'Data mata kuliah tidak berhasil dihapus.');
    }
}
