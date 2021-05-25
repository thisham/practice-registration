@extends('layouts.html')

@section('title', 'Ubah Password Akun')

@section('header')
    @include('components.navs.admin', ['page' => "pw-change"])
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
                <h3 class="card-title">
                   Ubah Password Akun
                </h3>
            </div>

            <div class="card-content">
                <form action="{{ route('admin-change-account-password') }}" method="POST">
                    @csrf

                    <div class="input-field">
                        <input type="password" name="oldpassword" id="oldpassword">
                        <label for="oldpassword">Password Lama</label>
                        @error('oldpassword')
                            <span class="text-helper red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="input-field">
                        <input type="password" name="newpassword" id="newpassword">
                        <label for="newpassword">Password Baru</label>
                        @error('newpassword')
                            <span class="text-helper red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="input-field">
                        <input type="password" name="newpassword_confirmation" id="newpassword_confirmation">
                        <label for="newpassword_confirmation">Konfirmasi Password Baru</label>
                    </div>
                    
                    <div class="input-field center">
                        <button type="submit" class="waves-effect waves-light btn btn-large indigo">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
