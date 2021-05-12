@extends('layouts.html')

@section('title', 'Tambah Data Laboratorium')

@section('header')
    @include('components.navs.admin', ['page' => "laboratories"])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@php
    $no = 1;
@endphp

@section('main')
    <div class="container" style="margin-top: 40px;">
        @if (Session::has('msgsuccess'))
            @include('components.messageboxes.success', ['message' => Session::get('msgsuccess')])
        @endif

        @if (Session::has('msgwarning'))
            @include('components.messageboxes.warning', ['message' => Session::get('msgwarning')])
        @endif

        @if (Session::has('msgfailed'))
            @include('components.messageboxes.failed', ['message' => Session::get('msgfailed')])
        @endif
        
        <div class="card">
            <div class="card-action grey lighten-4">
                <h3 class="card-title">Tambah Laboratorium</h3>
            </div>

            <div class="card-content">
                <form action="{{ route('admin-add-laboratory') }}" method="post">
                    @csrf

                    <div class="input-field">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required />
                        <label for="name">Nama Laboratorium</label>
                        @error('name')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input type="text" name="location" id="location" value="{{ old('location') }}" required />
                        <label for="location">Lokasi Laboratorium</label>
                        @error('location')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="center" style="margin-bottom: 20px;">
                        <button type="submit" id="submit" class="btn btn-large indigo waves-effect waves-light">
                            <i class="material-icons left">add</i> Tambah Laboratorium
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection