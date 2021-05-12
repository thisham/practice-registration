@extends('layouts.html')

@section('title', 'Detail Data Laboratorium')

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
        <div class="card">
            <div class="card-action grey lighten-4">
                <h3 class="card-title">Detail Laboratorium</h3>
            </div>

            <div class="card-content">
                <table>
                    <tr>
                        <th>Nama Laboratorium</th>
                        <td>{{ $laboratory->name }}</td>
                    </tr>
                    <tr>
                        <th>Lokasi Laboratorium</th>
                        <td>{{ $laboratory->location }}</td>
                    </tr>
                </table>

                <div class="center" style="margin-top: 20px;">
                    <a href="{{ route('admin-manage-laboratories') }}" class="btn btn-large indigo waves-effect waves-light">
                        <i class="material-icons left">arrow_back</i> Kembali ke List
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection