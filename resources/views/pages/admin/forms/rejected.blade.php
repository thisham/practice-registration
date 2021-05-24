@extends('layouts.html')

@section('title', 'Praktikum Ditolak')

@section('header')
    @include('components.navs.admin', ['page' => "rejected-practices"])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@php
    $no = 1;
@endphp

@section('main')
    <div class="container" style="margin-top: 40px;">
        @if (Session::has('msgsuccess'))
            @include('components.messageboxes.success', ['message' => Session::get('msgsuccess')])
        @endif

        @if (Session::has('msgwarning'))
            @include('components.messageboxes.warning', ['message' => Session::get('msgwarning')])
        @endif

        @if (Session::has('msgfailed'))
            @include('components.messageboxes.failed', ['message' => Session::get('msgfailed')])
        @endif

        <div class="card">
            <div class="card-action grey lighten-4">
                <h3 class="card-title">
                    Praktikum Ditolak
                </h3>
            </div>

            <div class="card-content" id="card-body">

            </div>
        </div>
    </div>
@endsection

<script>
    function getForms() {
        const cardBody = document.getElementById('card-body');

        fetch("{{ route('api-new-form-rejected-list') }}")
            .then(response => response.json())
            .then(function (data) {
                let id = '';
                if (data.length === 0) {
                    cardBody.innerHTML = '';
                    cardBody.innerHTML += `
                        <div class="grey lighten-4 center" style="border-radius: 8px; padding: 20px; font-size: 18pt; font-weight: bold;">
                            Tidak ada data.
                        </div>
                    `;
                } else {
                    cardBody.innerHTML = '';
                    data.forEach(element => {
                        id = element.type + '-' + element.id;
                        cardBody.innerHTML += `
                            <div class="grey lighten-4" style="border-radius: 8px; padding: 20px; margin-bottom: 20px;">
                                <div class="row" style="margin-bottom: 0px !important;">
                                    <div class="col l6 m8 s12">
                                        <div style="font-size: 18pt; font-weight: bold;">
                                            ${element.type}-${element.id} | ${element.laboratory}
                                        </div>

                                        <div style="font-size: 12pt;">
                                            ${element.practician}, ${element.practice_date} ${element.practice_time}
                                        </div>

                                        <div style="font-size: 12pt;">
                                            ${element.status}: ${element.submission}
                                        </div>
                                    </div>

                                    <div class="col l6 m4 s12">
                                        <button onclick="viewForm('${id}')" class="btn indigo waves-effect waves-light right" style="margin: 5px;">
                                            Lihat
                                        </button>

                                        <button onclick="acceptForm('${id}')" class="btn green waves-effect waves-light right" style="margin: 5px;">
                                            Accept
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                }
            });
    }

    function acceptForm(id) {
        fetch("{{ route('api-new-form-rejected-acc') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({'id': id})
        })
        .then(response => response.json())
        .then(function (data) {
            if (data.accepted)
                M.toast({html: 'Form berhasil di-acc.'});
            getForms();
        });
    }

    function viewForm(id) {
        window.location.href = `{{ route('admin-form-preview') }}?id=${id}`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        getForms();
        setInterval(function () {
            getForms();
        }, 10000);
    });
</script>
