<div class="card">
    <div class="card-action grey lighten-4">
        <h3 class="card-title">
            Informasi Anggota Praktikan
        </h3>
    </div>

    <div class="card-content">
        <b>Disclaimer: Jika akan melakukan praktikum seorang diri (tanpa anggota lain), Anda tidak wajib mengisi bagian ini. Harap hapus bagian ini jika Anda akan melakukan praktikum seorang diri.</b>
        <span>Gunakan Nomor Induk Mahasiswa jika Anda adalah seorang mahasiswa (baik dari dalam kampus maupun luar kampus).</span>

        <div id="practician_member_table">
            <div class="row" id="practician_member_row_0">
                <div class="input-field col l4 m4 s12">
                    <input type="text" name="practician_member_name[0]" id="practician_member_name_0" required />
                    <label for="practician_member_name">Nama Praktikan</label>
                </div>
        
                <div class="input-field col l4 m4 s12">
                    <input type="text" name="practician_member_id_number[0]" id="practician_member_id_number_0" required />
                    <label for="practician_member_id_number">NIM / NIK</label>
                </div>
        
                <div class="input-field col l4 m4 s12">
                    <input type="tel" name="practician_member_phone[0]" id="practician_member_phone_0" required />
                    <label for="practician_member_phone">Nomor HP</label>
                </div>
            </div>
        </div>

        <div class="right-align">
            <button class="btn indigo waves-effect waves-light" id="practician_member_add">Tambah</button>
            <button class="btn red waves-effect waves-light" id="practician_member_remove">Hapus</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let counter = 1;
        let memberDome = document.getElementById('practician_member_table');
        let addMember = document.getElementById('practician_member_add');
        let removeMember = document.getElementById('practician_member_remove');

        addMember.addEventListener('click', function (e) {
            e.preventDefault();
            let newElem = document.createElement('div');
            let pastElem = document.getElementById('practician_member_row_' + (counter - 1));
            newElem.setAttribute('id', 'practician_member_row_' + counter);
            newElem.classList.add('row');
            newElem.innerHTML = `
                <div class="input-field col">
                    <input type="text" name="practician_member_name[` + counter + `]" id="practician_member_name_` + counter + `" />
                    <label for="practician_member_name">Nama Praktikan</label>
                </div>
            
                <div class="input-field col">
                    <input type="text" name="practician_member_id_number[` + counter + `]" id="practician_member_id_number_` + counter + `" />
                    <label for="practician_member_id_number">NIM / NIK</label>
                </div>
        
                <div class="input-field col">
                    <input type="tel" name="practician_member_phone[` + counter + `]" id="practician_member_phone_` + counter + `" />
                    <label for="practician_member_phone">Nomor HP</label>
                </div>
            `;
            if (pastElem == null) 
                memberDome.insertAdjacentElement('afterbegin', newElem);
            
            if (pastElem != null)
                pastElem.parentNode.insertBefore(newElem, pastElem.nextSibling);
            counter += 1;
        });

        removeMember.addEventListener('click', function (e) {
            e.preventDefault();
            if (counter === 0) {
                M.toast({html: 'Tidak ada kolom anggota tersisa.'});
                return;
            }
            
            counter -= 1;
            let nowElem = document.getElementById('practician_member_row_' + counter);
            nowElem.remove();
        });
    });
</script>
