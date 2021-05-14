<div class="card">
    <div class="card-action grey lighten-4">
        <h3 class="card-title">
            Informasi Bahan yang Dibutuhkan
        </h3>
    </div>

    <div class="card-content">
        <b>Disclaimer: Harap hapus bagian ini jika tidak diperlukan.</b>
        <div id="material_table">
            <div class="row" id="material_row_0">
                <div class="input-field col">
                    <input type="text" name="material_name[0]" id="material_name_0" required />
                    <label for="material_name">Nama Bahan</label>
                </div>
        
                <div class="input-field col">
                    <input type="text" name="material_quantity[0]" id="material_quantity_0" />
                    <label for="material_quantity">Banyaknya</label>
                </div>
        
                <div class="input-field col">
                    <input type="text" name="material_status[0]" id="material_status_0" />
                    <label for="material_status">Status</label>
                </div>
            </div>
        </div>

        <div class="right-align">
            <button class="btn indigo waves-effect waves-light" id="material_add">Tambah</button>
            <button class="btn red waves-effect waves-light" id="material_remove">Hapus</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let counter = 1;
        let materialDome = document.getElementById('material_table');
        let addMaterial = document.getElementById('material_add');
        let removeMaterial = document.getElementById('material_remove');

        addMaterial.addEventListener('click', function (e) {
            e.preventDefault();
            let newElem = document.createElement('div');
            let pastElem = document.getElementById('material_row_' + (counter - 1));
            newElem.setAttribute('id', 'material_row_' + counter);
            newElem.classList.add('row');
            newElem.innerHTML = `
                <div class="input-field col">
                    <input type="text" name="material_name[` + counter + `]" id="material_name_` + counter + `" required />
                    <label for="material_name">Nama Bahan</label>
                </div>
        
                <div class="input-field col">
                    <input type="text" name="material_quantity[` + counter + `]" id="material_quantity_` + counter + `" />
                    <label for="material_quantity">Banyaknya</label>
                </div>
        
                <div class="input-field col">
                    <input type="text" name="material_status[` + counter + `]" id="material_status_` + counter + `" />
                    <label for="material_status">Status</label>
                </div>
            `;
            if (pastElem == null) 
                materialDome.insertAdjacentElement('afterbegin', newElem);
            
            if (pastElem != null)
                pastElem.parentNode.insertBefore(newElem, pastElem.nextSibling);
            counter += 1;
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
