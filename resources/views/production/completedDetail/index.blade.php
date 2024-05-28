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
                            <h1>Chi Tiết</h1>
                        </div>
                    </div>

                </div>



                <div class="row">
                    @foreach ($completeProductDetail as $index => $item)
                        @php
                            $qrcodes = App\Models\Inventory_product::where('product_input_id', $item->input_id)->get();
                        @endphp
                        @foreach ($qrcodes as $qrcode)
                            @if (!$qrcode->is_scanned)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100" style="width: 350px; background-color: dimgray; text-decoration: none; color: white;">
                                        <div class="card-body">
                                            <div class="text-center d-flex flex-column">
                                                <div class="qrcode">
                                                    {!! QrCode::size(150)->generate(url('/employee_prod/product/' . $item->input_id . '/' . $qrcode->sequence)) !!}
                                                </div>
                                            </div>
                                            <div class="product-info mt-4">
                                                {{-- <h2 class="card-title">Tên sản phẩm: {{ $item->product_name }}</h2> --}}
                                                {{-- <p class="card-text">Số lượng: 1</p> --}}
                                                {{-- <p class="card-text">Nhà cung cấp: {{ $item->employee_id }}</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (($index + 1) % 3 == 0 && $index + 1 < count($completeProductDetail))
                                    </div>
                                    <div class="row">
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </div>
                
                {{-- <div class="row">
                    @foreach ($completeProductDetail as $index => $item)
                        @php
                            $qrcodes = App\Models\Inventory_product::where('product_input_id', $item->input_id)->get();
                        @endphp
                        @foreach ($qrcodes as $qrcode)
                            @if (!$qrcode->is_scanned)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100" style="width: 350px; background-color: dimgray; text-decoration: none; color: white;">
                                        <div class="card-body">
                                            <div class="text-center d-flex flex-column">
                                                <div class="qrcode">
                                                    {!! QrCode::size(150)->generate(url('/employee_prod/product/' . $item->product_id . '/' . $qrcode->sequence)) !!}
                                                </div>
                                            </div>
                                            <div class="product-info mt-4">
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (($index + 1) % 3 == 0 && $index + 1 < count($completeProductDetail))
                                    </div>
                                    <div class="row">
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </div> --}}
                


            </div>
        </div>
    </section>
@endsection
 {{-- <h2 class="card-title">Tên sản phẩm: {{ $item->product_name }}</h2> --}}
                                                {{-- <p class="card-text">Số lượng: 1</p> --}}
                                                {{-- <p class="card-text">Nhà cung cấp: {{ $item->employee_id }}</p> --}}