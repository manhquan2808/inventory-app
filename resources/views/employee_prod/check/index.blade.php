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
                            <h1>KIỂM TRA SẢN PHẨM</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                @if (session()->has('success_message'))
                    <div class="alert alert-success">
                        {{ session()->get('success_message') }}
                    </div>
                @endif

                @if (session()->has('info_message'))
                    <div class="alert alert-info">
                        {{ session()->get('info_message') }}
                    </div>
                @endif

                @if (session()->has('error_message'))
                    <div class="alert alert-danger">
                        {{ session()->get('error_message') }}
                    </div>
                @endif

                @if ($product->status !== 'accept' && $product->status !== 'reject' && !$product->is_scanned)
                    <div class="card" id="card">
                        <div class="card-header">
                            Chi tiết sản phẩm
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Tên sản phẩm: {{ $product->product_name }}</h5>
                            <p class="card-text">Mã sản phẩm: {{ $product->product_id }}</p>
                            <p class="card-text">Thời gian nhập: {{ $product->date }}</p>
                            <p class="card-text">Thứ tự: {{ $product->sequence }}</p>

                            <div>
                                <form method="POST"
                                    action="{{ route('inventory.accept', ['product_id' => $product->input_id, 'sequence' => $product->sequence]) }}"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" value="{{ $product->input_id }}" name="input_id">
                                    <input type="hidden" value="{{ $product->product_id }}" name="product_id">
                                    <input type="hidden" value="{{ $product->sequence }}" name="sequence">
                                    <button type="submit" class="btn btn-primary btn-sm">Nhận hàng</button>
                                </form>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">Từ
                                    chối</button>
                            </div>
                        </div>
                    </div>
                @elseif ($product->status !== 'accept' && $product->status !== 'reject' && $product->is_scanned)
                    <div class="card" id="card">
                        <div class="card-header">
                            Chi tiết sản phẩm
                        </div>
                        <div class="card-body">
                            <p style="color: red">Sản phẩm đã được quét nhưng chưa kiểm tra</p>
                            <h5 class="card-title">Tên sản phẩm: {{ $product->product_name }}</h5>
                            <p class="card-text">Mã sản phẩm: {{ $product->product_id }}</p>
                            <p class="card-text">Thời gian nhập: {{ $product->date }}</p>
                            <p class="card-text">Thứ tự: {{ $product->sequence }}</p>

                            <div>
                                <form method="POST"
                                    action="{{ route('inventory.accept', ['product_id' => $product->input_id, 'sequence' => $product->sequence]) }}"
                                    style="display: inline;">
                                    @csrf
                                    <input type="hidden" value="{{ $product->input_id }}" name="input_id">
                                    <input type="hidden" value="{{ $product->product_id }}" name="product_id">
                                    <input type="hidden" value="{{ $product->sequence }}" name="sequence">
                                    <button type="submit" class="btn btn-primary btn-sm">Nhận hàng</button>
                                </form>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalId">Từ
                                    chối</button>
                            </div>
                        </div>
                    </div>
                @endif


                <div class="table-responsive mt-lg-auto pt-10">
                    <table class="table table-primary">
                        <thead class="align-content-center justify-center">
                            <tr class="align-items-center">
                                <th>Tên sản phẩm</th>
                                <th>Thời gian</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory_product as $item)
                                <tr class="align-items-center">
                                    <td>{{ $item->name_of_check }}</td>
                                    <td>{{ $item->last_updated }}</td>
                                    <td>{{ $item->status_label }}</td>
                                    <td><button class="btn btn-outline-info " href="#" role="button"> Xem</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($product->status !== 'accept' && $product->status !== 'reject' && !$product->is_scanned)
            <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
                role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <form
                    action="{{ route('inventory.reject', ['product_id' => $product->input_id, 'sequence' => $product->sequence]) }}"
                    method="POST">
                    @csrf
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">Nhập lý do từ chối</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="reason">Lý do:</label>
                                    <textarea class="form-control " id="reason" name="reason" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-danger">Từ chối</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </section>
@endsection
