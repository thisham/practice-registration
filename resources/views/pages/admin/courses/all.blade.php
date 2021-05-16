@extends('layouts.html')

@section('title', 'Data Mata Kuliah')

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
                <h3 class="card-title">Semua Mata Kuliah</h3>
            </div>

            <div class="card-content">
                <div class="center" style="margin-bottom: 20px;">
                    <a href="{{ route('admin-add-course') }}" class="btn indigo waves-effect waves-light">
                        <i class="material-icons left">add</i> Tambah Mata Kuliah
                    </a>
                </div>

                <table class="table striped">
                    <tr>
                        <th class="center">No.</th>
                        <th class="center">Nama</th>
                        <th class="center">Status</th>
                        <th class="center">Aksi</th>
                    </tr>

                    @if (count($courses) > 0)
                        @foreach ($courses as $course)
                            <tr>
                                <td class="center">{{ $no++ }}</td>
                                <td>{{ $course->name }}</td>
                                <td class="center">
                                    @if ($course->is_active)
                                        <span class="material-icons left green-text">check</span> Aktif
                                    @else
                                        <span class="material-icons left red-text">close</span> Tidak Aktif
                                    @endif
                                </td>
                                <td class="center">
                                    <a href="{{ route('admin-show-course', ['id' => $course->id]) }}" class="btn btn-small indigo waves-effect waves-light">
                                        <i class="material-icons">info</i>
                                    </a>
                                    
                                    <a href="{{ route('admin-edit-course', ['id' => $course->id]) }}" class="btn btn-small orange waves-effect waves-light">
                                        <i class="material-icons">edit</i>
                                    </a>

                                    <button onclick="deletecourse('{{ route('admin-delete-course', ['id' => $course->id]) }}')" class="btn btn-small red waves-effect waves-light">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach                            
                    @else
                        <tr>
                            <td class="center" colspan="3">Tidak ada data.</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection

<script>
    function deletecourse(url) {
        Swal.fire({
            title: 'Yakin menghapus data?',
            text: "Anda tidak akan dapat mengembalikan aksi penghapusan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>