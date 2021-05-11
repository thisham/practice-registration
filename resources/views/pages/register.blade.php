@extends('layouts.html')

@section('title', 'Login - Pendaftaran Praktikum')

@section('header')
    @include('components.navs.open', ['page' => "login"])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('main')
    <br>
    <br>
    <div class="container center">
        <div class="card">
            <div class="card-action center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="max-height: 75px;">
            </div>

            <div class="card-content">
                <span class="card-title center">Buat Akun Sistem</span>

                @if (Session::has('msgsuccess'))
                    @include('components.messageboxes.success', ['message' => Session::get('msgsuccess')])
                @endif

                @if (Session::has('msgwarning'))
                    @include('components.messageboxes.warning', ['message' => Session::get('msgwarning')])
                @endif

                @if (Session::has('msgfailed'))
                    @include('components.messageboxes.failed', ['message' => Session::get('msgfailed')])
                @endif

                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-field">
                        <input id="name" name="name" type="text" class="validate" required>
                        <label for="name">Nama</label>
                        @error('name')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="input-field">
                        <input id="email" name="email" type="email" class="validate" required>
                        <label for="email">Email</label>
                        @error('email')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field left-aligned">
                        <input id="password" name="password" type="password" class="validate" required>
                        <label for="password">Password</label>
                        @error('password')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input id="password" name="password_confirmation" type="password" class="validate" required>
                        <label for="password_confirmation">Konfirmasi Password</label>
                        @error('password_confirmation')
                            <span class="red-text helper-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <button type="submit" class="waves-effect waves-light btn btn-large indigo">Masuk</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
