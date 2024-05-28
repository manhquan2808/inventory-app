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
                            <h1>NHẬP NGUYÊN LIỆU</h1>
                        </div>
                    </div>
                    <div>
                        <div class="col-md-12">
                            <a href="{{ route('material-management.requirelist') }}" type="button" class="btn btn-outline-primary">Xem danh sách yêu cầu</a>
                        </div>
                    </div>
                </div>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="{{ route('material-management.submit') }}" method="POST">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="d-flex justify-content-center">
                        <div class="mb-3 w-50">
                            <label for="material" class="form-label">Nguyên liệu</label>
                            <select class="form-select bg-transparent text-white @error('name') is-invalid @enderror"
                                name="name" id="name">
                                <option selected style="color: black;" value="">Chọn nguyên liệu</option>
                                @foreach ($materials as $material)
                                    <option style="color: black;" class="select-option"
                                        value="{{ $material->material_id }}">{{ $material->material_name }}</option>
                                @endforeach
                            </select>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="mb-3 w-50">
                            <label for="supplier" class="form-label">Nhà cung cấp</label>
                            <select class="form-select bg-transparent text-white @error('supplier') is-invalid @enderror"
                                name="supplier" id="supplier">
                                <option selected style="color: black;" value="">Chọn nhà cung cấp</option>
                                @foreach ($suppliers as $supplier)
                                    <option style="color: black;" class="select-option"
                                        value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            @error('supplier')
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
    </section>
@endsection
