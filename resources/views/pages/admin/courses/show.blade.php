@extends('layouts.html')

@section('title', 'Detail Data Mata Kuliah')

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
        <div class="card">
            <div class="card-action grey lighten-4">
                <h3 class="card-title">Detail Mata Kuliah</h3>
            </div>

            <div class="card-content">
                <table>
                    <tr>
                        <th>Kode Mata Kuliah</th>
                        <td>{{ $course->code }}</td>
                    </tr>

                    <tr>
                        <th>Nama Mata Kuliah</th>
                        <td>{{ $course->name }}</td>
                    </tr>

                    <tr>
                        <th>Tahun Kurikulum</th>
                        <td>{{ $course->curriculum }}</td>
                    </tr>

                    <tr>
                        <th>Status Mata Kuliah</th>
                        <td>
                            @if ($course->is_active)
                                <span class="material-icons left green-text">check</span> Aktif
                            @else
                                <span class="material-icons left red-text">close</span> Tidak Aktif
                            @endif
                        </td>
                    </tr>
                </table>

                <div class="center" style="margin-top: 20px;">
                    <a href="{{ route('admin-manage-courses') }}" class="btn btn-large indigo waves-effect waves-light">
                        <i class="material-icons left">arrow_back</i> Kembali ke List
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection