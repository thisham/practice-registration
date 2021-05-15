@extends('layouts.html')

@section('title', 'Edit Data Laboratorium')

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
                <h3 class="card-title">Perbarui Laboratorium</h3>
            </div>

            <div class="card-content">
                <form action="{{ route('admin-edit-laboratory', ['id' => $laboratory->id]) }}" method="post">
                    @csrf

                    <div class="input-field">
                        <input type="text" name="name" id="name" value="{{ $laboratory->name }}" required />
                        <label for="name">Nama Laboratorium</label>
                        @error('name')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input type="text" name="location" id="location" value="{{ $laboratory->location }}" required />
                        <label for="location">Lokasi Laboratorium</label>
                        @error('location')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <label>
                            <input 
                                type="checkbox" 
                                name="is_active" 
                                id="is_active" 
                                @if ($laboratory->is_active)
                                    checked
                                @endif
                            />
                            <span class="black-text">Laboratorium Beroperasi</span>
                        </label>
                    </div>

                    <div class="center" style="margin-bottom: 20px; margin-top: 80px;">
                        <button type="submit" id="submit" class="btn btn-large indigo waves-effect waves-light">
                            <i class="material-icons left">update</i> Perbarui Data Laboratorium
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection