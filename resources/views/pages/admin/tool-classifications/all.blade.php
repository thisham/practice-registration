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
                <h3 class="card-title">Semua Alat</h3>
            </div>

            <div class="card-content">
                <div class="center" style="margin-bottom: 20px;">
                    <a href="{{ route('admin-add-tool') }}" class="btn indigo waves-effect waves-light">
                        <i class="material-icons left">add</i> Tambah Alat
                    </a>
                </div>

                <table class="table striped responsive-table">
                    <tr>
                        <th class="center">No.</th>
                        <th class="center">Nama</th>
                        <th class="center">Ukuran</th>
                        <th class="center">Kelas</th>
                        <th class="center">Jumlah</th>
                        <th class="center">Aksi</th>
                    </tr>

                    @if (count($tools) > 0)
                        @foreach ($tools as $tool)
                            <tr>
                                <td class="center">{{ $no++ }}</td>
                                <td>{{ $tool->name }}</td>
                                <td>{{ $tool->size }}</td>
                                <td>{{ $tool->class }}</td>
                                <td>{{ $tool->amount }}</td>
                                <td class="center">
                                    <a href="{{ route('admin-show-tool', ['id' => $tool->id]) }}" class="btn btn-small indigo waves-effect waves-light">
                                        <i class="material-icons">info</i>
                                    </a>
                                    
                                    <a href="{{ route('admin-edit-tool', ['id' => $tool->id]) }}" class="btn btn-small orange waves-effect waves-light">
                                        <i class="material-icons">edit</i>
                                    </a>

                                    <button onclick="deleteTool('{{ route('admin-delete-tool', ['id' => $tool->id]) }}')" class="btn btn-small red waves-effect waves-light">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach                            
                    @else
                        <tr>
                            <td class="center" colspan="6">Tidak ada data.</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection

<script>
    function deleteTool(url) {
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