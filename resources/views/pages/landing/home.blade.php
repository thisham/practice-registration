@extends('layouts.html')

@section('title', 'Booking Online Praktikum')

@section('header')
    @include('components.navs.public', ['page' => "landing"])
@endsection

@section('footer')
    @include('components.landing-footer')
@endsection

@section('main')
    <div class="slider">
        <ul class="slides">
            <li>
                <img src="{{ asset('img/background.svg') }}"> <!-- random image -->
                <div class="caption center-align">
                <h3>Laboratorium Simulasi Apotek</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
            <li>
                <img src="{{ asset('img/background.svg') }}"> <!-- random image -->
                <div class="caption left-align">
                <h3>Laboratorium Farmasetika</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
            <li>
                <img src="{{ asset('img/background.svg') }}"> <!-- random image -->
                <div class="caption right-align">
                <h3>Laboratorium Instrumentasi</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
            <li>
                <img src="{{ asset('img/background.svg') }}"> <!-- random image -->
                <div class="caption center-align">
                <h3>Laboratorium Biologi Farmasi</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
            <li>
                <img src="{{ asset('img/background.svg') }}"> <!-- random image -->
                <div class="caption left-align">
                <h3>Laboratorium Teknologi Farmasi</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
            <li>
                <img src="{{ asset('img/background.svg') }}"> <!-- random image -->
                <div class="caption right-align">
                <h3>Laboratorium Kimia Farmasi</h3>
                <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                </div>
            </li>
        </ul>
    </div>

    <div id="link-booking">
        <div class="container">
            <div class="center">
                <h4>
                    Booking Online Praktikum di UPT Laboratorium Pusat
                </h4>
                <h6>
                    Cermati tata cara dan aturan sesuai dengan SOP yang sudah ditetapkan. Booking online dapat dilakukan selama 24 jam dan disarankan untuk booking dilakukan tiga hari sebelum tanggal pelaksanaan praktikum.
                </h6>
                <br>
                <a href="{{ route('register-new-practice') }}" class="btn btn-large indigo waves-effect waves-light">Booking Sekarang</a>
            </div>
        </div>
    </div>

    <br><br>

    <div id="alur-daftar" class="white center">
        <div style="margin-left: 5%; margin-right: 5%;">
            <br>
            <div class="center">
                <h3>Alur Registrasi</h3>
            </div>
            <br>
            <div class="row">
                <div class="col m4 s12">
                    <div class="card">
                        <div class="card-content" style="height: 250px">
                            <center>
                                <div class="indigo lighten-5 indigo-text circle-with-text">1</div>
                                <br>
                                <span class="card-title">Portal Booking Online</span>
                                <p>Disarankan menggunakan PC untuk mendapatkan pengalaman terbaik.</p>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card">
                        <div class="card-content" style="height: 250px">
                            <center>
                                <div class="indigo lighten-5 indigo-text circle-with-text">2</div>
                                <br>
                                <span class="card-title">SOP Praktikum</span>
                                <p>Cermati Standar Operasional Prosedur dan taati peraturan praktikum sebelum melaksanakan praktikum.</p>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card">
                        <div class="card-content" style="height: 250px">
                            <center>
                                <div class="indigo lighten-5 indigo-text circle-with-text">3</div>
                                <br>
                                <span class="card-title">Pilih Lab dan Jadwal</span>
                                <p>Pilih laboratorium tempat praktikum dan tentukan tanggal</p>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card">
                        <div class="card-content" style="height: 250px">
                            <center>
                                <div class="indigo lighten-5 indigo-text circle-with-text">4</div>
                                <br>
                                <span class="card-title">Pengisian Form</span>
                                <p>Lengkapi Biodata, pastikan alamat email dan nomor HP benar. Email persetujuan akan dikirim ke email ketua kelompok.</p>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card">
                        <div class="card-content" style="height: 250px">
                            <center>
                                <div class="indigo lighten-5 indigo-text circle-with-text">5</div>
                                <br>
                                <span class="card-title">Cek Kode Booking</span>
                                <p>Setelah melakukan pendaftaran, cek kode booking melalui email atau melalui website di menu Cek Status Booking.</p>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card">
                        <div class="card-content" style="height: 250px">
                            <center>
                                <div class="indigo lighten-5 indigo-text circle-with-text">6</div>
                                <br>
                                <span class="card-title">Verifikasi Data</span>
                                <p>Admin akan melakukan verifikasi data Booking Online anda. Setelah data disetujui, ketua akan mendapat email persetujuan.</p>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card">
                        <div class="card-content" style="height: 250px">
                            <center>
                                <div class="indigo lighten-5 indigo-text circle-with-text">7</div>
                                <br>
                                <span class="card-title">Cek Registrasi</span>
                                <p>Petugas Laboratorium akan melakukan pengecekan formulir dengan meminta nomor registrasi yang telah dikirimkan.</p>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <br><br>
    </div>

    <div id="statistik" class="center" style="background-image: url({{ asset('img/background.svg') }})">
        <div style="margin-left: 5%; margin-right: 5%;">
            <br>
            <div class="center">
                <h3 class="white-text">Statistik Praktikum</h3>
            </div>
            <br>
            <div class="row">
                <div class="col m4 s12">
                    <div class="card indigo darken-2">
                        <div class="card-content">
                            <i class="material-icons white-text" style="font-size: 45pt;">person</i>
                            <br>
                            <span class="center white-text" style="font-size: 28pt;">4582</span>
                            <br>
                            <span class="center white-text" style="font-size: 16pt;">Karya Tulis Ilmiah</span>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card indigo darken-2">
                        <div class="card-content">
                            <i class="material-icons white-text" style="font-size: 45pt;">person</i>
                            <br>
                            <span class="center white-text" style="font-size: 28pt;">3571</span>
                            <br>
                            <span class="center white-text" style="font-size: 16pt;">Reguler</span>
                        </div>
                    </div>
                </div>
                <div class="col m4 s12">
                    <div class="card indigo darken-2">
                        <div class="card-content">
                            <i class="material-icons white-text" style="font-size: 45pt;">person</i>
                            <br>
                            <span class="center white-text" style="font-size: 28pt;">1623</span>
                            <br>
                            <span class="center white-text" style="font-size: 16pt;">Karya Tulis Ilmiah</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="download" class="center">
        <div style="margin-left: 5%; margin-right: 5%;">
            <br>
            <div class="center">
                <h3>Download</h3>
            </div>
            <br>

            <div class="collection left-align">
                <a href="#!" class="collection-item indigo-text">
                    <h6>Standar Operasional Praktikum <i class="material-icons right">arrow_right</i></h6>
                </a>
                
                <a href="#!" class="collection-item indigo-text">
                    <h6>Daftar Inventaris <i class="material-icons right">arrow_right</i></h6>
                </a>
                
                <a href="#!" class="collection-item indigo-text">
                    <h6>Daftar Alat dan Bahan <i class="material-icons right">arrow_right</i></h6>
                </a>
                
                <a href="#!" class="collection-item indigo-text">
                    <h6>Jadwal Mata Kuliah Praktikum Reguler <i class="material-icons right">arrow_right</i></h6>
                </a>
            </div>
            
        </div>
        <br><br>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.slider');
            var instances = M.Slider.init(elems);
        });
    </script>
@endsection