@extends('employee_prod.layouts.app')
@section('content')
    @include('employee_prod.slidebar.slide')
    <section id="wrapper">
        @include('employee_prod.header.index')

        <div class="p-4">
            <div class="statistics mt-4">
                <div class="row">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h1>DANH SÁCH NHẬN HÀNG</h1>
                        </div>
                    </div>
                </div>
            </div>
            @livewire('employee-prod.product-list')
           
        </div>
    </section>
@endsection