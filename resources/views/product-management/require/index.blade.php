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
                            <h1>YÊU CẦU SẢN XUẤT</h1>

                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between me-5">
                        <a href="{{ route('product-management.requirelist') }}" type="button" class="btn btn-outline-primary">Xem danh sách</a>
                    </div>
                    <form action="{{ route('product-management.submit') }}" method="POST">
                        @csrf <!-- {{ csrf_field() }} -->
                        <div class="d-flex justify-content-center">
                            <div class="mb-3 w-50">
                                <label for="product" class="form-label">Sản phẩm</label>
                                <select class="form-select bg-transparent text-white @error('name') is-invalid @enderror"
                                    name="name" id="name">
                                    <option selected style="color: black;" value="">Chọn sản phẩm</option>
                                    @foreach ($products as $product)
                                        <option style="color: black;" class="select-option"
                                            value="{{ $product->product_id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="mb-3 w-50">
                                <label for="quantity" class="form-label">Số lượng</label>
                                <input id="quantity" name="quantity" type="number"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    placeholder="Nhập số lượng yêu cầu sản xuất">
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
                        </div>
                    </form>




                </div>
            </div>
            {{-- @livewire('product.products-table') --}}
        </div>
    </section>
@endsection
