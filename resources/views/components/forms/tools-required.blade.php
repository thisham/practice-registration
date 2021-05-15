<div class="card">
    <div class="card-action grey lighten-4">
        <h3 class="card-title">
            Informasi Alat yang Dipakai
        </h3>
    </div>

    <div class="card-content">
        <b>Disclaimer: Harap hapus bagian ini jika tidak diperlukan.</b>
        <div id="tool_table">
            <div class="row" id="tool_row_0">
                <div class="input-field col l8 m8 s12">
                    <select name="tool_name[0]" id="tool_name_0" required>
                        <option value="" disabled selected>Pilih Alat</option>
                        @foreach ($tools as $tool)
                            <option value="{{ $tool->id }}">{{ $tool->name }} {{ $tool->size }}</option>
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
            let toolData = {!! $tools !!};
            toolData.forEach(element => {
                toolOptions += "<option value='" + element.id +"'>" + element.name + " " + element.size + "</option>"
            });
            newElem.setAttribute('id', 'tool_row_' + counter);
            newElem.classList.add('row');
            newElem.innerHTML = `
                <div class="input-field col">
                    <select name="tool_name[` + counter + `]" id="tool_name_` + counter + `" required>
                        <option value="" disabled selected>Pilih Alat</option> ` + toolOptions + `
                    </select>
                    <label for="name">Nama Alat</label>
                </div>
        
                <div class="input-field col">
                    <input type="number" name="tool_quantity[` + counter + `]" id="tool_quantity_` + counter + `" required />
                    <label for="quantity">Jumlah</label>
                </div>
            `;
            if (pastElem == null) 
                toolDome.insertAdjacentElement('afterbegin', newElem);
            
            if (pastElem != null)
                pastElem.parentNode.insertBefore(newElem, pastElem.nextSibling);
            
            M.FormSelect.init(document.getElementById('tool_name_' + counter));
            counter += 1;
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
