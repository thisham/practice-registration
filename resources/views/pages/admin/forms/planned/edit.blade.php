@extends('layouts.html')

@section('title', 'Rencana Praktikum')

@section('header')
    @include('components.navs.admin', ['page' => "practice-plans"])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@php
    $no = 1;
@endphp

@section('main')
    <div class="container" style="margin-top: 40px;">
        <form action="{{ route('admin-practice-plan-set-done', ['id' => sprintf('%s-%s', $form->type, $form->id)]) }}" method="post">
            @csrf

            <div class="card">
                <div class="card-action grey lighten-4">
                    <h3 class="card-title">
                        Informasi Praktikum
                    </h3>
                </div>
            
                <div class="card-content">
                    <table>
                        <tr>
                            <th>Judul Penelitian</th>
                            <td>{{ $form->theme ?? '---' }}</td>
                        </tr>
                        <tr>
                            <th>Tipe Praktikum</th>
                            <td>
                                @switch($form->type)
                                    @case('KTI')
                                        KTI - Karya Tulis Ilmiah
                                        @break
                                    @case('EXT')
                                        EXT - Praktikum Eksternal
                                        @break
                                    @default
                                        REG - Praktikum Mata Kuliah Reguler
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Mata Kuliah Praktikum</th>
                            <td>{{ $course->code }} - {{ $course->name }}</td>
                        </tr>
                        <tr>
                            <th>Dosen</th>
                            <td>{{ $form->lecturer }}</td>
                        </tr>
                        <tr>
                            <th>Laboratorium</th>
                            <td>{{ $laboratory->name }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal dan Waktu</th>
                            <td>{{ $form->practice_date }} {{ $form->practice_start_time }}</td>
                        </tr>
                        <tr>
                            <th>Institusi Asal</th>
                            <td>{{ $form->institution }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card">
                <div class="card-action grey lighten-4">
                    <h3 class="card-title">
                        Informasi Praktikan
                    </h3>
                </div>
            
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            @if ($form->practicians > 1)
                                <b style="font-size: 14pt;">Informasi Ketua Praktikan</b>
                            @else
                                <b style="font-size: 14pt;">Informasi Praktikan</b>
                            @endif

                            <table>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $leader->name }}</td>
                                </tr>
                                <tr>
                                    <th>No. Identitas</th>
                                    <td>{{ $leader->id_number }}</td>
                                </tr>
                                <tr>
                                    <th>No. HP</th>
                                    <td>{{ $leader->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat Email</th>
                                    <td>{{ $leader->email }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Praktikan</th>
                                    <td>{{ $form->practicians }}</td>
                                </tr>
                            </table>

                            @if ($form->type != 'REG' && $form->practicians > 1)
                                <div class="divider" style="margin-top: 20px;"></div>
                                
                                @php
                                    $no = 1;
                                @endphp

                                <div class="row" style="margin-top: 20px;">
                                    <div class="col s12">
                                        <b style="font-size: 14pt;">Anggota Praktikan</b>

                                        <table class="table">
                                            <tr>
                                                <th>No.</th>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>No. HP</th>
                                            </tr>

                                            @foreach ($members as $member)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $member->id_number }}</td>
                                                    <td>{{ $member->name }}</td>
                                                    <td>{{ $member->phone }}</td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-action grey lighten-4">
                    <h3 class="card-title">
                        Informasi Alat yang Dipakai
                    </h3>
                </div>

                @php
                    $no = 1;
                @endphp
            
                <div class="card-content">
                    <b style="font-size: 14pt;">Rencana Peminjaman</b>
                    
                    <table>
                        <tr>
                            <thead>
                                <th>No.</th>
                                <th>QTY</th>
                                <th>Nama</th>
                                <th>Ukuran</th>
                            </thead>

                            <tbody>
                                @forelse ($tools as $tool)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>
                                            <input
                                                type="number" 
                                                name="tool_quant[]" 
                                                style="max-width: 50px;"
                                                value="{{ $tool->quantity }}"
                                            >
                                        </td>
                                        <td>{{ $tool->name }}</td>
                                        <td>{{ $tool->size }}</td>
                                        <input type="hidden" name="tool_id[]" value="{{ $tool->id }}">
                                    </tr>
                                @empty
                                    <tr>
                                        <td 
                                            class="center" 
                                            colspan="4" 
                                            style="font-weight: bold;"
                                        >Tidak ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </tr>
                    </table>

                    <div class="divider" style="margin-top: 20px;"></div>
                    <br>
                    <b style="font-size: 14pt; margin-bottom: 20px;">Tambahan Alat Peminjaman</b>
                    <br>
                    <b>Disclaimer: Harap hapus bagian ini jika tidak diperlukan.</b>
                    <div id="tool_table">
                        <div class="row" style="margin-bottom: 0px;" id="tool_row_0">
                            <div class="input-field col l8 m8 s12">
                                <select name="tool_name[0]" id="tool_name_0" required>
                                    <option value="" disabled selected>Pilih Alat</option>
                                    @foreach ($tool_classifications as $tc)
                                        <option value="{{ $tc->id }}">{{ $tc->name }} {{ $tc->size }}</option>
                                    @endforeach
                                </select>
                                <label for="name">Nama Alat</label>
                            </div>
                    
                            <div class="input-field col l4 m4 s12">
                                <input type="number" name="tool_quantity[0]" id="tool_quantity_0" required />
                                <label for="quantity">Jumlah</label>
                            </div>
                        </div>
                    </div>
            
                    <div class="right-align">
                        <button class="btn indigo waves-effect waves-light" id="tool_add">Tambah</button>
                        <button class="btn red waves-effect waves-light" id="tool_remove">Hapus</button>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-action grey lighten-4">
                    <h3 class="card-title">
                        Informasi Bahan yang Dibutuhkan
                    </h3>
                </div>

                @php
                    $no_material = 0;
                @endphp
            
                <div class="card-content">
                    <b style="font-size: 14pt; margin-bottom: 20px;">Pemakaian Bahan Praktikum</b>
                    <br>
                    <b>Disclaimer: Harap hapus bagian ini jika tidak diperlukan.</b>
                    <div id="material_table">
                        @forelse ($materials as $material)
                            <div class="row" style="margin-bottom: 0px;" id="material_row_{{ $no_material }}">

                                <div class="input-field col l4 m4 s12">
                                    <input type="text" name="material_name[{{ $no_material }}]" id="material_name_{{ $no_material }}" value="{{ $material->name }}" required />
                                    <label for="material_name">Nama Bahan</label>
                                </div>
                        
                                <div class="input-field col l4 m4 s12">
                                    <input type="text" name="material_quantity[{{ $no_material }}]" id="material_quantity_{{ $no_material }}" value="{{ $material->quantity }}" />
                                    <label for="material_quantity">Banyaknya</label>
                                </div>
                        
                                <div class="input-field col l4 m4 s12">
                                    <input type="text" name="material_status[{{ $no_material }}]" id="material_status_{{ $no_material++ }}" value="{{ $material->status }}" />
                                    <label for="material_status">Status</label>
                                </div>
                            </div>
                        @empty
                            <div class="row" style="margin-bottom: 0px;" id="material_row_{{ $no_material }}">

                                <div class="input-field col l4 m4 s12">
                                    <input type="text" name="material_name[{{ $no_material }}]" id="material_name_{{ $no_material }}" required />
                                    <label for="material_name">Nama Bahan</label>
                                </div>
                        
                                <div class="input-field col l4 m4 s12">
                                    <input type="text" name="material_quantity[{{ $no_material }}]" id="material_quantity_{{ $no_material }}" />
                                    <label for="material_quantity">Banyaknya</label>
                                </div>
                        
                                <div class="input-field col l4 m4 s12">
                                    <input type="text" name="material_status[{{ $no_material }}]" id="material_status_{{ $no_material++ }}" />
                                    <label for="material_status">Status</label>
                                </div>
                            </div>
                            
                        @endforelse
                    </div>
            
                    <div class="right-align">
                        <button class="btn indigo waves-effect waves-light" id="material_add">Tambah</button>
                        <button class="btn red waves-effect waves-light" id="material_remove">Hapus</button>
                    </div>
                </div>
            </div>  
            
            <div class="card">
                <div class="card-action grey lighten-4">
                    <h3 class="card-title">
                        Persetujuan
                    </h3>
                </div>
            
                <div class="card-content">
                    <div class="input-field center">
                        <input type="hidden" name="form_id" value="{{ $form->id }}" />

                        <button type="submit" class="btn indigo btn-large waves-effect waves-light">
                            Kirim
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let counter = 1;
        let toolDome = document.getElementById('tool_table');
        let addTool = document.getElementById('tool_add');
        let removeTool = document.getElementById('tool_remove');

        addTool.addEventListener('click', function (e) {
            e.preventDefault();
            let newElem = document.createElement('div');
            let pastElem = document.getElementById('tool_row_' + (counter - 1));
            let toolOptions = "";
            let toolData = {!! $tool_classifications !!};
            toolData.forEach(element => {
                toolOptions += "<option value='" + element.id +"'>" + element.name + " " + element.size + "</option>"
            });
            newElem.setAttribute('id', 'tool_row_' + counter);
            newElem.classList.add('row');
            newElem.style.marginBottom = '0px';
            newElem.innerHTML = `
                <div class="input-field col l8 m8 s12">
                    <select name="tool_name[` + counter + `]" id="tool_name_` + counter + `" required>
                        <option value="" disabled selected>Pilih Alat</option> ` + toolOptions + `
                    </select>
                    <label for="name">Nama Alat</label>
                </div>
        
                <div class="input-field col l4 m4 s12">
                    <input type="number" name="tool_quantity[` + counter + `]" id="tool_quantity_` + counter + `" required />
                    <label for="quantity">Jumlah</label>
                </div>
            `;
            if (pastElem == null) 
                toolDome.insertAdjacentElement('afterbegin', newElem);
            
            if (pastElem != null)
                pastElem.parentNode.insertBefore(newElem, pastElem.nextSibling);
            
            M.FormSelect.init(document.getElementById('tool_name_' + counter));
            counter++;
        });

        removeTool.addEventListener('click', function (e) {
            e.preventDefault();
            if (counter === 0) {
                M.toast({html: 'Tidak ada kolom alat tersisa.'});
                return;
            }

            counter -= 1;
            let nowElem = document.getElementById('tool_row_' + counter);
            nowElem.remove();
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let counter = "{{ $no_material }}";
        let materialDome = document.getElementById('material_table');
        let addMaterial = document.getElementById('material_add');
        let removeMaterial = document.getElementById('material_remove');

        addMaterial.addEventListener('click', function (e) {
            e.preventDefault();
            let newElem = document.createElement('div');
            let pastElem = document.getElementById('material_row_' + (counter - 1));
            newElem.setAttribute('id', 'material_row_' + counter);
            newElem.classList.add('row');
            newElem.style.marginBottom = '0px';
            newElem.innerHTML = `
                <div class="input-field col l4 m4 s12">
                    <input type="text" name="material_name[` + counter + `]" id="material_name_` + counter + `" required />
                    <label for="material_name">Nama Bahan</label>
                </div>
        
                <div class="input-field col l4 m4 s12">
                    <input type="text" name="material_quantity[` + counter + `]" id="material_quantity_` + counter + `" />
                    <label for="material_quantity">Banyaknya</label>
                </div>
        
                <div class="input-field col l4 m4 s12">
                    <input type="text" name="material_status[` + counter + `]" id="material_status_` + counter + `" />
                    <label for="material_status">Status</label>
                </div>
            `;
            if (pastElem == null) 
                materialDome.insertAdjacentElement('afterbegin', newElem);
            
            if (pastElem != null)
                pastElem.parentNode.insertBefore(newElem, pastElem.nextSibling);
            counter++;
        });

        removeMaterial.addEventListener('click', function (e) {
            e.preventDefault();
            if (counter === 0) {
                M.toast({html: 'Tidak ada kolom bahan tersisa.'});
                return;
            }

            counter -= 1;
            let nowElem = document.getElementById('material_row_' + counter);
            nowElem.remove();
        });
    });
</script>