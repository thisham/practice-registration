@extends('layouts.html')

@section('title', 'Dasbor Administrator')

@section('header')
    @include('components.navs.admin', ['page' => "login"])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('main')
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <div class="col l3 m6 s12">
                <div class="card">
                    <div class="row" style="padding: 20px;">
                        <div class="col left s6">
                            <i class="material-icons" style="font-size: 45pt;">description</i>
                        </div>

                        <div class="col right s6">
                            <span class="right" style="font-size: 28pt;">{{ $form_all }}</span>
                        </div>

                        <div class="col s12 center">
                            <span class="center" style="font-size: 16pt;">Form Praktikum</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l3 m6 s12">
                <div class="card">
                    <div class="row" style="padding: 20px;">
                        <div class="col left s6">
                            <i class="material-icons" style="font-size: 45pt;">task</i>
                        </div>

                        <div class="col right s6">
                            <span class="right" style="font-size: 28pt;">{{ $form_history }}</span>
                        </div>

                        <div class="col s12 center">
                            <span class="center" style="font-size: 16pt;">Prakt. Terlaksana</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l3 m6 s12">
                <div class="card">
                    <div class="row" style="padding: 20px;">
                        <div class="col left s6">
                            <i class="material-icons" style="font-size: 45pt;">architecture</i>
                        </div>

                        <div class="col right s6">
                            <span class="right" style="font-size: 28pt;">{{ $tools_count }}</span>
                        </div>

                        <div class="col s12 center">
                            <span class="center" style="font-size: 16pt;">Alat Tersedia</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l3 m6 s12">
                <div class="card">
                    <div class="row" style="padding: 20px;">
                        <div class="col left s6">
                            <i class="material-icons" style="font-size: 45pt;">sensor_door</i>
                        </div>

                        <div class="col right s6">
                            <span class="right" style="font-size: 28pt;">{{ $labs_count }}</span>
                        </div>

                        <div class="col s12 center">
                            <span class="center" style="font-size: 16pt;">Laboratorium</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection