@extends('layouts.html')

@section('title', 'Registrasi Praktikum Eksternal')

@section('header')
    @include('components.navs.public', ['page' => "login"])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('main')
    <div class="container" style="margin-top: 40px;">
        <form action="{{ route('register-fill-ext-practice-data') }}" method="post">
            @csrf

            @include('components.forms.practice-info', ['practice' => $practice])

            @include('components.forms.practician-leader')

            @include('components.forms.non-regular-practicians')

            @include('components.forms.tools-required')

            @include('components.forms.materials-required')

            @include('components.forms.form-submit')
        </form>
    </div>
@endsection