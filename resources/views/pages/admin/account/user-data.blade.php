@extends('layouts.html')

@section('title', 'Ubah Informasi Akun')

@section('header')
    @include('components.navs.admin', ['page' => "info-change"])
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
                   Ubah Informasi Akun
                </h3>
            </div>

            <div class="card-content">
                <form action="{{ route('admin-change-account-info') }}" method="POST">
                    @csrf

                    <div class="input-field">
                        <input type="text" name="name" id="name" value="{{ $user->name }}"  />
                        <label 
                            for="name" 
                            @if ($user->name != '')
                                class="active"
                            @endif
                        >Nama</label>
                        @error('name')
                            <span class="text-helper red-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-field">
                        <input type="email" name="email" id="email" value="{{ $user->email }}"  />
                        <label 
                            for="email" 
                            @if ($user->email != '')
                                class="active"
                            @endif
                        >Email</label>
                        @error('email')
                            <span class="text-helper red-text">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="input-field center">
                        <button type="submit" class="waves-effect waves-light btn btn-large indigo">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
