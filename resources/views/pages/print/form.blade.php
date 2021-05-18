@extends('layouts.print')

@section('title', 'Formulir Registrasi Praktikum - ' . $form->type . '-' . $form->id)

@section('form')
    @include('components.prints.form', ['form' => $form, 'tools' => $tools, 'materials' => $materials, 'course' => $course, 'laboratory' => $laboratory])
@endsection

@section('summary')
    @include('components.prints.summary', ['tools' => $tools, 'materials' => $materials])
@endsection

@section('tools')
    @include('components.prints.tools', ['form' => $form, 'tools' => $tools, 'materials' => $materials, 'course' => $course, 'laboratory' => $laboratory])
@endsection
