@extends('product-management.layouts.app')
@section('content')
    @include('product-management.slidebar.slide')
    <section id="wrapper">
        @include('product-management.header.index')
        <div class="p-4">
            <div class="statistics mt-4">
                <div class="row">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h1>DANH SÁCH SẢN PHẨM</h1>

                        </div>
                    </div>
                </div>
            </div>
            @livewire('product.products-table')
        </div>
    </section>
@endsection
