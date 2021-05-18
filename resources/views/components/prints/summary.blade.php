
<div class="pr-mb-1 pr-bold pr-center" style="font-size: 18px;">
    Daftar Alat
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
                    <th class="pr-center">QTY</th>
                    <th class="pr-center">Nama Alat</th>
                    <th class="pr-center">Ukuran</th>
                </tr>
            </thead>
            
            <tbody>
                @if (count($tools) > 0)
                    @foreach ($tools as $tool)
                        <tr>
                            <td class="pr-center">{{ $no++ }}</td>
                            <td class="pr-center">{{ $tool->quantity }}</td>
                            <td>{{ $tool->name }}</td>
                            <td>{{ $tool->size }}</td>
                        </tr>
                    @endforeach
                @endif

                @if ($no < 13)
                    @for ($i = $no; $i <= 13; $i++)
                        <tr>
                            <td class="pr-center" style="padding: 14px;"></td>
                            <td class="pr-center" style="padding: 14px;"></td>
                            <td style="padding: 14px;"></td>
                            <td style="padding: 14px;"></td>
                        </tr>
                    @endfor
                @endif
            </tbody>
        </table>
    </div>
</div>

<div class="pr-hdivider"></div>

<div class="pr-mb-1 pr-bold pr-center" style="font-size: 18px;">
    Daftar Bahan
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
                    <th class="pr-center">QTY</th>
                    <th class="pr-center">Nama Bahan</th>
                    <th class="pr-center">Status</th>
                </tr>
            </thead>
            
            <tbody>
                @if (count($materials) > 0)
                    @foreach ($materials as $material)
                        <tr>
                            <td class="pr-center">{{ $no++ }}</td>
                            <td class="pr-center">{{ $material->quantity }}</td>
                            <td>{{ $material->name }}</td>
                            <td>{{ $material->status }}</td>
                        </tr>
                    @endforeach
                @endif

                @if ($no < 13)
                    @for ($i = $no; $i <= 13; $i++)
                        <tr>
                            <td class="pr-center" style="padding: 14px;"></td>
                            <td class="pr-center" style="padding: 14px;"></td>
                            <td style="padding: 14px;"></td>
                            <td style="padding: 14px;"></td>
                        </tr>
                    @endfor
                @endif
            </tbody>
        </table>
    </div>
</div>