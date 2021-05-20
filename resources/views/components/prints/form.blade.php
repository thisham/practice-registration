<div class="pr-row">
    <div class="pr-col s6">
        <div class="pr-bold" style="font-size: 18pt;">Formulir Registrasi Praktikum</div>
    </div>
    
    <div class="pr-col s6 pr-right-align">
        <div class="pr-bold" style="font-size: 14pt;">{{ $form->type . '-' . $form->id }}</div>
        <div>{{ date('d M Y H.i.s', strtotime($form->created_at . '+7 hours')) }}</div>
    </div>
</div>

<div class="pr-hdivider"></div>

@if ($form->theme != NULL)
    <div class="pr-row pr-mb-1">
        <div class="pr-row s12 pr-center">
            Judul: <div class="pr-bold" style="font-size: 18px;">"{{ $form->theme ?? '' }}"</div>
        </div>
    </div>
@endif

<div class="pr-row pr-mb-2">
    <div class="pr-col s6">
        <div class="pr-mb-1 pr-bold">Informasi Praktikum</div>
        <div>{{ $laboratory->name }}</div>
        <div>{{ $course->code }} - {{ $course->name }}</div>
        <div>{{ $form->lecturer }}</div>
        <div>{{ $form->practice_date }} || {{ $form->practice_start_time }}</div>
        <div>{{ $form->institution }}</div>
    </div>

    <div class="pr-col s6">
        @if ($form->practicians > 1)
            <div class="pr-mb-1 pr-bold">Informasi Ketua Praktikan</div>
        @else
            <div class="pr-mb-1 pr-bold">Informasi Praktikan</div>
        @endif
        <div>{{ $leader->name }}</div>
        <div>ID: {{ $leader->id_number }}</div>
        <div>{{ $leader->phone }}</div>
        <div>{{ $leader->email }}</div>
        <b>{{ $form->practicians }} Orang Praktikan</b>
    </div>
</div>

<div class="pr-hdivider"></div>

<div class="pr-center pr-mb-2">
    <div class="pr-mb-1">
        Status Terakhir Form
    </div>

    @switch($status->status)
        @case('submitted')
            <div class="pr-badge pr-orange">
                <i class="material-icons pr-left">done</i>{{ $status->status . ' at ' . $status->created_at }}
            </div>
            @break
            
        @case('accepted')
            <div class="pr-badge pr-green">
                <i class="material-icons pr-left">done_all</i>{{ $status->status . ' at ' . $status->created_at }}
            </div>
            @break
            
        @case('rejected')
            <div class="pr-badge pr-red">
                <i class="material-icons pr-left">close</i>{{ $status->status . ' at ' . $status->created_at }}
            </div>
            @break
            
        @case('cancelled')
            <div class="pr-badge pr-red">
                <i class="material-icons pr-left">not_interested</i>{{ $status->status . ' at ' . $status->created_at }}
            </div>
            @break
            
        @default
            <div class="pr-badge pr-grey">
                <i class="material-icons pr-left">task</i>{{ $status->status . ' at ' . $status->created_at }}
            </div>
    @endswitch
</div>

<div class="pr-hdivider"></div>

@if ($form->type != 'REG')
    <div class="pr-mb-1 pr-bold pr-center" style="font-size: 18px;">
        Daftar Anggota Praktikan
    </div>

    <div class="pr-row pr-mb-2">
        <div class="pr-col s12">
            @php
                $no = 1;
            @endphp

            <table>
                <thead>
                    <tr>
                        <th class="pr-center">No.</th>
                        <th class="pr-center">Nomor ID</th>
                        <th class="pr-center">Nama</th>
                        <th class="pr-center">No. HP</th>
                    </tr>
                </thead>
                
                <tbody>
                    @forelse ($members as $member)
                        <tr>
                            <td class="pr-center">{{ $no++ }}</td>
                            <td>{{ $member->id_number }}</td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->phone }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td class="pr-center" colspan="4">Tidak ada data.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="pr-hdivider"></div>
@endif

<div class="pr-row pr-mt-5">
    <div class="pr-col s6">
        <div class="pr-mb-5">Praktikan,</div>
        <div>{{ $leader->name }}</div>
        <div>ID. {{ $leader->id_number }}</div>
    </div>

    <div class="pr-col s6">
        <div class="pr-mb-5">Laboran,</div>
        <div>_________________________</div>
    </div>
</div>
