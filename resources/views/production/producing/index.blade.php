@extends('production.layouts.app')
@section('content')
    @include('production.slidebar.slide')
    <section id="wrapper">
        @include('production.header.index')

        <div class="p-4">
            <div class="statistics mt-4">
                <div class="row">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h1>Thực Hiện Sản Xuất</h1>
                        </div>
                    </div>
                </div>
               @livewire('production.producing-table')
            </div>
        </div>
    </section>
@endsection