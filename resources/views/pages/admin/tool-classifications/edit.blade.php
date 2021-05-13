@extends('layouts.html')

@section('title', 'Data Klasifikasi Alat')

@section('header')
    @include('components.navs.admin', ['page' => "tool-classifications"])
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
                <h3 class="card-title">Perbarui Data Alat</h3>
            </div>

            <div class="card-content">
                <form action="{{ route('admin-edit-tool', $tool->id) }}" method="post">
                    @csrf

                    <div class="input-field">
                        <input type="text" name="name" id="name" value="{{ $tool->name }}" required>
                        <label for="name">Nama Alat</label>
                        @error('name')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input type="text" name="size" id="size" value="{{ $tool->size }}">
                        <label for="size">Ukuran (Opsional)</label>
                        @error('size')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <select name="class" id="class" required>
                            <option value="" disabled>Pilih Kelas Alat</option>
                            <option value="A" @if ($tool->class == 'A') selected @endif>A - Diulang sesuai jumlah peminjaman</option>
                            <option value="B" @if ($tool->class == 'B') selected @endif>B - Cukup ditulis jumlah peminjaman</option>
                            <option value="C" @if ($tool->class == 'C') selected @endif>C - Alat memiliki buku log tersendiri</option>
                        </select>
                        <label for="class">Kelas Alat</label>
                        @error('class')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input type="number" name="amount" id="amount" value="{{ $tool->amount }}" required>
                        <label for="amount">Jumlah Alat Tersedia</label>
                        @error('amount')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="center" style="margin-bottom: 20px;">
                        <button type="submit" id="submit" class="btn btn-large indigo waves-effect waves-light">
                            <i class="material-icons left">add</i> Perbarui Profil Alat
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
