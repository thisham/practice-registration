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
        <div class="card">
            <div class="card-action grey lighten-4">
                <h3 class="card-title">Data Alat</h3>
            </div>

            <div class="card-content">
                <table class="table">
                    <tr>
                        <th>ID Alat</th>
                        <td>{{ $tool->id }}</td>
                    </tr>
                    <tr>
                        <th>Nama Alat</th>
                        <td>{{ $tool->name }}</td>
                    </tr>
                    <tr>
                        <th>Ukuran</th>
                        <td>{{ $tool->size }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>
                            @switch($tool->class)
                                @case('A')
                                    A - Diulang sesuai jumlah peminjaman
                                    @break
                                @case('B')
                                    B - Cukup ditulis jumlah peminjaman
                                    @break
                                @default
                                    C - Alat memiliki buku log tersendiri
                            @endswitch
                        </td>
                    </tr>
                    <tr>
                        <th>Jumlah Alat</th>
                        <td>{{ $tool->amount }} unit</td>
                    </tr>
                </table>

                <div class="center" style="margin-top: 20px;">
                    <a href="{{ route('admin-manage-tools') }}" class="btn btn-large indigo waves-effect waves-light">
                        <i class="material-icons left">arrow_back</i> Kembali ke List
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
