@extends('layouts.html')

@section('title', 'Cek Registrasi Praktikum')

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
               Cari Praktikum
            </h3>
        </div>

        <div class="card-content">
            <form action="{{ route('check-registration-number') }}" method="get">
                <div class="input-field">
                    <input type="text" name="code" id="code" required />
                    <label for="code">Kode Booking</label>
                    @error('code')
                        <span class="helper-text red-text">{{ $message }}</span>
                    @enderror
                </div>
    
                <div class="input-field center">
                    <button type="submit" class="btn btn-large indigo waves-effect waves-light">
                        <i class="material-icons left">search</i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection