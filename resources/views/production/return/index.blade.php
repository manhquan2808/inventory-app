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
                            <h1>Danh Sách Hàng Trả</h1>
                        </div>
                    </div>
                </div>
                {{-- @livewire('production.return-table') --}}
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <div class="bg-transparent dark:bg-gray-800 overflow-hidden">
                        <div class="flex items-center justify-between p-4">
                            <div class="d-flex align-items-center justify-content-between me-5">
                            </div>
                        </div>
                        <div class="overflow-x-auto d-flex justify-content-center">
                            <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase">
                                    <tr class="text-light  text-center">
                                        <th>Mã lô</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Thứ tự trong lô</th>
                                        <th>Lý do</th>
                                        <th>Ngày trả</th>
                                        <th></th>
                                        {{-- <th class="px-4 py-3"></th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($products->count() > 0)
                                        @foreach ($products as $product)
                                            <tr class="border-b dark-border-gray-700 text-light text-center">
                                                <td class="px-4 py-3">{{ $product->product_input_id }}</td>
                                                <td class="px-4 py-3">{{ $product->product_id }}</td>
                                                <td class="px-4 py-3">{{ $product->product_name }}</td>
                                                <td class="px-4 py-3">{{ $product->sequence }}</td>
                                                <td class="px-4 py-3">{{ $product->reason }}</td>
                                                <td class="px-4 py-3">{{ $product->last_updated }}</td>
                                                <td class="px-4 py-3  flex justify-center ">

                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" style="text-align: center"><small>Không có dữ liệu
                                                    trùng
                                                    khớp</small></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{-- <button wire:click="add()">click me</button> --}}
                        <div class="py-4 px-3">
                            <div class="flex">
                                <div class="flex space-x-4 items-center mb-3">
                                    <label class="text-white">Số trang</label>
                                    <select wire:model.live="perPage">
                                        <option value="100">100</option>
                                        <option value="200">200</option>
                                        <option value="500">500</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
