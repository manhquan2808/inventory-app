@extends('material-management.layouts.app')
@section('content')
    @include('material-management.slidebar.slide')
    <section id="wrapper">
        @include('material-management.header.index')
        <div class="p-4">
            <div class="statistics mt-4">
                <div class="row">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h1>DANH SÁCH NGUYÊN LIỆU</h1>
                        </div>
                    </div>
                </div>
            </div>
            @livewire('material.material-table')
        </div>
    </section>
@endsection
