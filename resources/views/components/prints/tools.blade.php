<div class="pr-page">
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

    <div class="pr-row">
        <div class="pr-col s6">
            <div>
                {{ $leader->name }} / {{ $leader->id_number }}
            </div>
            
            <div>
                {{ $leader->email }}
            </div>

            <div>
                {{ $leader->phone }}
            </div>
        </div>

        <div class="pr-col s6">
            <div>
                {{ date('d M Y', strtotime($form->practice_date)) }}
            </div>
            
            <div>
                {{ $course->code . ' - ' . $course->name }}
            </div>

            <div>
                {{ $form->lecturer }}
            </div>
        </div>
    </div>

    <div class="pr-row pr-mb-2 pr-mt-2">
        <div class="pr-col s12">
            @php
                $no = 1;
            @endphp

            @if ($form->type == 'REG')
                <table>
                    <thead>
                        <tr>
                            <th class="pr-center" rowspan="2">No.</th>
                            <th class="pr-center" rowspan="2">Nama Alat</th>
                            <th class="pr-center" rowspan="2">QTY</th>
                            <th class="pr-center" colspan="2">Pinjam</th>
                            <th class="pr-center" colspan="2">Kembali</th>
                            <th class="pr-center" rowspan="2">Keterangan</th>
                        </tr>

                        <tr>
                            <th class="pr-center">MHS</th>
                            <th class="pr-center">LAB</th>
                            <th class="pr-center">MHS</th>
                            <th class="pr-center">LAB</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($tools as $tool)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $tool->name }} {{ $tool->size }}</td>
                                <td>{{ $tool->quantity }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        
                        @for ($i = $no; $i <= 55; $i++)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            @else
                <table>
                    <thead>
                        <tr>
                            <th class="pr-center" rowspan="2">No.</th>
                            <th class="pr-center" rowspan="2">Nama Alat</th>
                            <th class="pr-center" rowspan="2">No. Alat</th>
                            <th class="pr-center" colspan="2">Pinjam</th>
                            <th class="pr-center" colspan="2">Kembali</th>
                            <th class="pr-center" rowspan="2">Keterangan</th>
                        </tr>

                        <tr>
                            <th class="pr-center">MHS</th>
                            <th class="pr-center">LAB</th>
                            <th class="pr-center">MHS</th>
                            <th class="pr-center">LAB</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($tools as $tool)
                            @if ($tool->class == 'A')
                                @for ($j = 0; $j < $tool->quantity; $j++)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $tool->name }} {{ $tool->size }}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endfor
                            @else
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $tool->name }} {{ $tool->size }}</td>
                                    <td>(x {{ $tool->quantity }})</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                        
                        @for ($i = $no; $i <= 55; $i++)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

