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
    @if (Session::has('msgsuccess'))
        @include('components.messageboxes.success', ['message' => Session::get('msgsuccess')])
    @endif

    <div class="card" style="margin-bottom: 20px;">
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

    <div class="card">
        <div class="card-action grey lighten-4">
            <h3 class="card-title">
                Formulir Registrasi Praktikum
            </h3>
        </div>

        <div class="card-content">
            <div class="row">
                <div class="col s12">
                    <div style="font-size: 18pt; font-style: oblique;">Praktikum <mark>{{ $form->type }}-{{ $form->id }}</mark></div>
                    <div>Waktu Registrasi: {{ date('d M Y, H:i:s', strtotime($form->created_at . '+7 hours')) }}</div>
                    <div class="divider"></div>
                </div>
            </div>

            <div class="row">
                <div class="col s6">
                    <b>Informasi Praktikum</b>
                    <br>
                    <p>{{ $laboratory->name }}</p>
                    <p>{{ $course->code }} - {{ $course->name }}</p>
                    <p>{{ $form->lecturer }}</p>
                    <p>{{ $form->practice_date }} || {{ $form->practice_start_time }}</p>
                    <p>{{ $form->institution }}</p>
                </div>

                <div class="col s6">
                    @if ($form->practicians > 1)
                        <b>Informasi Ketua Praktikan</b>
                    @else
                        <b>Informasi Praktikan</b>
                    @endif
                    <br>
                    <p>{{ $leader->name }}</p>
                    <p>ID: {{ $leader->id_number }}</p>
                    <p>{{ $leader->phone }}</p>
                    <p>{{ $leader->email }}</p>
                    <b>{{ $form->practicians }} Orang Praktikan</b>
                </div>
            </div>
            
            <div class="row divider"></div>
            
            @if ($form->type != 'REG' && $form->practicians > 1)
                @php
                    $no = 1;
                @endphp

                <div class="row">
                    <div class="col s12">
                        <b style="font-size: 14pt;">Anggota Praktikan</b>

                        <table class="table">
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>No. HP</th>
                            </tr>

                            @foreach ($members as $member)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->phone }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="divider" style="margin-bottom: 20px;"></div>
            @endif
            
            <div class="row">
                <div class="col s12">
                    @php
                        $no = 1;
                    @endphp

                    <b style="font-size: 14pt;">Daftar Alat</b>

                    <table class="table">
                        <tr>
                            <th class="center">No.</th>
                            <th class="center">QTY</th>
                            <th class="center">Nama Alat</th>
                            <th class="center">Ukuran</th>
                        </tr>

                        @if (count($tools) > 0)
                            @foreach ($tools as $tool)
                                <tr>
                                    <td class="center">{{ $no++ }}</td>
                                    <td class="center">{{ $tool->quantity }}</td>
                                    <td>{{ $tool->name }}</td>
                                    <td>{{ $tool->size }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="center" colspan="4">Tidak ada data.</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
            
            <div class="row">
                <div class="col s12">
                    @php
                        $no = 1;
                    @endphp

                    <b style="font-size: 14pt;">Daftar Bahan</b>

                    <table class="table">
                        <tr>
                            <th class="center">No.</th>
                            <th class="center">QTY</th>
                            <th class="center">Nama Bahan</th>
                            <th class="center">Status</th>
                        </tr>

                        @if (count($materials) > 0)
                            @foreach ($materials as $material)
                                <tr>
                                    <td class="center">{{ $no++ }}</td>
                                    <td class="center">{{ $material->quantity }}</td>
                                    <td>{{ $material->name }}</td>
                                    <td>{{ $material->status }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="center" colspan="4">Tidak ada data.</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col s12">
                    @php
                        $no = 1;
                    @endphp

                    <b style="font-size: 14pt;">Status Pengajuan</b>

                    <table class="table">
                        <tr>
                            <th class="center">No.</th>
                            <th>Status</th>
                            <th>Pesan</th>
                            <th>Timestamp</th>
                        </tr>

                        @if (count($statuses) > 0)
                            @foreach ($statuses as $status)
                                <tr>
                                    <td class="center">{{ $no++ }}</td>
                                    <td>
                                        <i class="material-icons left">
                                            @switch($status->status)
                                                @case('submitted')
                                                    done
                                                    @break
                                                @case('accepted')
                                                    done_all
                                                    @break
                                                @case('rejected')
                                                    close
                                                    @break
                                                @case('cancelled')
                                                    not_interested
                                                    @break
                                                @default
                                                    task
                                            @endswitch
                                        </i>
                                        {{ $status->status }}
                                    </td>
                                    <td>{{ $status->message ?? '-' }}</td>
                                    <td>{{ date('d M Y H.i.s', strtotime($status->created_at . '+7 hours')) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="center" colspan="4">Tidak ada data.</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>

            <div class="row center">
                <div class="col s12">
                    <a href="{{ route('check-registration-number-print', ['id' => $form->type . '-' . $form->id]) }}" class="btn btn-large indigo waves-effect waves-light">
                        <i class="material-icons left">print</i> Cetak Dokumen
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
