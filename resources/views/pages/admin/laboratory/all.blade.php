@extends('layouts.html')

@section('title', 'Data Laboratorium')

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
                <h3 class="card-title">Semua Laboratorium</h3>
            </div>

            <div class="card-content">
                <div class="center" style="margin-bottom: 20px;">
                    <a href="{{ route('admin-add-laboratory') }}" class="btn indigo waves-effect waves-light">
                        <i class="material-icons left">add</i> Tambah Laboratorium
                    </a>
                </div>

                <table class="table striped">
                    <tr>
                        <th class="center">No.</th>
                        <th class="center">Nama</th>
                        <th class="center">Status</th>
                        <th class="center">Aksi</th>
                    </tr>

                    @if (count($laboratories) > 0)
                        @foreach ($laboratories as $laboratory)
                            <tr>
                                <td class="center">{{ $no++ }}</td>
                                <td>{{ $laboratory->name }}</td>
                                <td class="center">
                                    @if ($laboratory->is_active)
                                        <span class="material-icons left green-text">check</span> Beroperasi
                                    @else
                                        <span class="material-icons left red-text">close</span> Tidak Beroperasi
                                    @endif
                                </td>
                                <td class="center">
                                    <a href="{{ route('admin-show-laboratory', ['id' => $laboratory->id]) }}" class="btn btn-small indigo waves-effect waves-light">
                                        <i class="material-icons">info</i>
                                    </a>
                                    
                                    <a href="{{ route('admin-edit-laboratory', ['id' => $laboratory->id]) }}" class="btn btn-small orange waves-effect waves-light">
                                        <i class="material-icons">edit</i>
                                    </a>

                                    <button onclick="deleteLaboratory('{{ route('admin-delete-laboratory', ['id' => $laboratory->id]) }}')" class="btn btn-small red waves-effect waves-light">
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
    function deleteLaboratory(url) {
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