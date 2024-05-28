@extends('supp.layouts.app')
@section('content')
    @include('supp.slidebar.slide')
    <section id="wrapper">
        @include('supp.header.index')

        <div class="p-4">
            <div class="statistics mt-4">
                <div class="row">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h1>DANH SÁCH YÊU CẦU</h1>
                        </div>
                    </div>
                   
                </div>
                @livewire('supp.require-table')
            </div>
        </div>
    </section>
@endsection
