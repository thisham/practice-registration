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
        @if (Session::has('msgfailed'))
            @include('components.messageboxes.failed', ['message' => Session::get('msgfailed')])
        @endif
        
        <div class="card">
            <div class="card-action grey lighten-4">
                <h3 class="card-title">
                    Pilih Waktu dan Laboratorium Praktikum
                </h3>
            </div>

            <div class="card-content">
                <form action="{{ route('register-set-time-and-place') }}" method="post">
                    @csrf
                    
                    <div class="input-field" id="date-field">
                        <input type="date" name="date" id="date" class="validate" required>
                        <label for="date">Tanggal Praktikum</label>
                        <span class="helper-text">Tips: Format tanggal : Bulan / Tanggal / Tahun</span>
                        @error('date')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field" id="time-field" style="margin-top: 30px;">
                        <input type="time" name="time" id="time" class="validate" required>
                        <label for="time">Waktu Mulai Praktikum</label>
                        <span class="helper-text">Tips: AM digunakan sebelum pukul 12.00 siang, PM digunakan sejak pukul 12.00 siang.</span>
                        @error('time')
                            <span class="helper-text red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="input-field" id="laboratory-field" style="margin-top: 30px;">
                        <select name="laboratory" id="laboratory" required>
                            <option value="" id="laboratory-default" disabled selected>Pilih Laboratorium</option>
                            @foreach ($laboratories as $laboratory)
                                <option value="{{ $laboratory->id }}">{{ $laboratory->name }}</option>
                            @endforeach
                        </select>
                        <label for="laboratory">Laboratorium</label>
                    </div>

                    <div class="input-field" id="type-field" style="margin-top: 30px;">
                        <select name="type" id="type" required>
                            <option value="" id="type-default" disabled selected>Pilih Jenis Praktikum</option>
                            <option value="KTI">Karya Tulis Ilmiah</option>
                            <option value="REG">Reguler</option>
                            <option value="EXT">Praktikum Luar Kampus</option>
                        </select>
                        <label for="type">Jenis Praktikum</label>
                    </div>

                    <div class="input-field center">
                        <button type="submit" class="btn btn-large indigo waves-effect waves-light">Teruskan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection