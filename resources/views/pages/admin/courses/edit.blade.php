@extends('layouts.html')

@section('title', 'Tambah Data Mata Kuliah')

@section('header')
    @include('components.navs.admin', ['page' => "courses"])
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
                <h3 class="card-title">Tambah Mata Kuliah</h3>
            </div>

            <div class="card-content">
                <form action="{{ route('admin-edit-course') }}" method="post">
                    @csrf

                    <div class="input-field">
                        <input type="text" name="code" id="code" value="{{ $course->code }}">
                        <label for="code">Kode Mata Kuliah</label>
                        @error('code')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input type="text" name="name" id="name" value="{{ $course->name }}">
                        <label for="name">Nama Mata Kuliah</label>
                        @error('name')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input type="text" name="curriculum" id="curriculum" value="{{ $course->curriculum }}">
                        <label for="curriculum">Tahun Kurikulum</label>
                        @error('curriculum')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <select name="type" id="type" required>
                            <option 
                                value="" 
                                disabled>Pilih Jenis Praktikum</option>
                            <option 
                                value="KTI" 
                                @if ($course->type === 'KTI')
                                    selected
                                @endif>Karya Tulis Ilmiah</option>
                            <option 
                                value="REG" 
                                @if ($course->type === 'REG')
                                    selected
                                @endif>Reguler</option>
                            <option 
                                value="EXT" 
                                @if ($course->type === 'EXT')
                                    selected
                                @endif>Praktikum Luar Kampus</option>
                        </select>
                        <label for="type">Jenis Praktikum</label>
                    </div>

                    <div class="input-field">
                        <label>
                            <input type="checkbox" name="is_active" id="is_active" />
                            <span class="black-text">Mata Kuliah Aktif</span>
                        </label>
                    </div>

                    <div class="center" style="margin-bottom: 20px; margin-top: 80px;">
                        <button type="submit" id="submit" class="btn btn-large indigo waves-effect waves-light">
                            <i class="material-icons left">add</i> Tambah Mata Kuliah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection