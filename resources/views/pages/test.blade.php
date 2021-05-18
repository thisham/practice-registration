@extends('layouts.html')

@section('title', 'Test Page')

@section('header')
    @include('components.navs.open', ['page' => ''])
@endsection

@section('footer')
    @include('components.footer')
@endsection

@section('main')
    <div id="test">
        <div class="input-field">
            <select name="tool" id="tool">
                <option value="" disabled selected>Select</option>
                @foreach ($tools as $tool)
                    <option value="{{ }}"></option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

<script>
    function selectWhere(source, whereName) {
        return source.filter(function (row) {
            return row.name === whereName
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        let elems = document.getElementById('test');
        let meta = {!! $tools !!};
        let grouped = selectWhere(meta, 'Beaker Glass');
        elems.innerHTML = grouped[1].size;
    });
</script>