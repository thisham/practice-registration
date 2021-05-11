@extends('layouts.html')

@section('title', 'Registrasi Praktikum')

@section('header')
    @include('components.navs.public', ['page' => "login"])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('main')
    <div class="container center" style="margin-top: 40px;">
        <h3>SOP Pendaftaran Praktikum</h3>
        
        <div class="card" style="margin-top: 20px;">
            <div class="card-action grey lighten-4">
                <h3 class="card-title left-align">Pendaftaran Praktikum</h3>
            </div>

            <div class="card-content">
                <div class="left-align">
                    Pendaftaran praktikum di UPT Laboratorium Pusat dilakukan dengan sistem online, dengan ketentuan sebagai berikut:
                </div>
                
                <ul class="collection left-align">
                    <li class="collection-item red-text">
                        Waktu pelayanan verifikasi data booking dilakukan pada hari Senin s.d Jumat pukul 07.00 s.d 15.30 WIB. Proses maksimal 1x24 jam (hari kerja) setelah melakukan registrasi.
                    </li>
                    
                    <li class="collection-item red-text">
                        Waktu praktikum yang dapat dilayani yaitu dimulai dari pukul 08.00 s.d 18.30 WIB.
                    </li>

                    <li class="collection-item red-text">
                        Pendaftaran dilakukan minimal 7 (tujuh) hari dan maksimal 3 (tiga) hari sebelum praktikum dilaksanakan.
                    </li>

                    <li class="collection-item red-text">
                        Praktikum dapat dilakukan oleh 1 (satu) orang atau lebih dengan salah satu orang menjadi penanggung jawab praktikum beserta administrasinya.
                    </li>

                    <li class="collection-item">
                        Pendaftaran dilakukan bagi calon praktikan, baik reguler, peneliti KTI maupun peneliti dari luar institusi.
                    </li>

                    <li class="collection-item">
                        Pendaftaran praktikum dilakukan secara online di situs <a href="{{ route('landing-page') }}">ini</a> dengan mengikuti alur pendaftaran yang tersedia.
                    </li>

                    <li class="collection-item">
                        Konfirmasi pendaftaran akan diterima calon praktikan melalui email. Pastikan alamat email benar karena konfirmasi pendaftaran praktikum akan dikirim ke alamat email yang Anda gunakan ketika mendaftar. Apabila tidak ada pesan pemberitahuan pada kotak masuk email, harap periksa pada kotak SPAM. 
                    </li>

                    <li class="collection-item">
                        <b>Barangsiapa melakukan tindak pidana penipuan atau pemalsuan tidak akan diberikan izin untuk melakukan praktikum apapun di UPT Laboratorium Pusat Akademi Farmasi Mitra Sehat Mandiri Sidoarjo (Blacklist).</b>
                    </li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-action grey lighten-4">
                <h3 class="card-title left-align">Contact Person</h3>
            </div>

            <div class="card-content">
                @include('components.credentials.cp-lab')
            </div>
        </div>

        <div class="card">
            <div class="card-action grey lighten-4">
                <h3 class="card-title left-align">Persetujuan</h3>
            </div>

            <div class="card-content">
                <p class="left-align">
                    <label>
                        <input type="checkbox" name="agreement" id="agreement" onchange="enableButton()" />
                        <span class="black-text">Saya telah membaca, menyetujui dan mengikuti semua peraturan dan SOP diatas </span>
                    </label>
                </p>

                <a href="{{ route('register-set-time-and-place') }}" id="continue-to-form" class="btn btn-large indigo waves-effect waves-light disabled" style="margin-top: 40px;">Daftar</a>
            </div>
        </div>
    </div>

    <script>
        function enableButton () {
            let cont = document.getElementById('continue-to-form');
            if (cont.classList.contains('disabled')) {
                cont.classList.remove('disabled');
                return;
            }
            
            cont.classList.add('disabled');
            return;
        }

        window.onload = event => {
            let agreement = document.getElementById('agreement');
            if (agreement.checked === true)
            agreement.checked = false;
        }
    </script>
@endsection