@extends('layouts.html')

@section('title', 'Registrasi Praktikum')

@section('header')
    @include('components.navs.public', ['page' => "login"])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('main')
    <div class="container" style="margin-top: 40px;">
        @include('components.forms.practice-info', ['practice' => $practice])

        @include('components.forms.practician-leader')

        @if ($practice->type == 'REG')
            @include('components.forms.regular-practicians')
        @else
            @include('components.forms.non-regular-practicians')
        @endif

        @include('components.forms.tool-required')

        @include('components.forms.material-required')
    </div>
@endsection