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
                            <h1>Nguyên Liệu Đã Gửi</h1>
                        </div>
                    </div>

                </div>

              

                <div class="row">
                    @foreach ($acceptedMaterials as $index => $item)
                        <div class="col-md-4 mb-3">
                            <div class="card h-100" style="width: 350px; background-color: dimgray;">
                                <div class="card-body">
                                    <div class="text-center d-flex flex-column">
                                        <div class="qrcode" id="qrcode{{ $index }}">
                                            {!! $qrcodes[$index] !!}
                                        </div>
                                    </div>
                                    <div class="product-info mt-4">
                                        <h2 class="card-title">Tên nguyên liệu: {{ $item->material_name }}</h2>
                                        <p class="card-text">Số lượng: {{ $item->quantity }}</p>
                                        <p class="card-text">Nhà cung cấp: {{ $item->supplier_name }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (($index + 1) % 3 == 0 && $index + 1 < count($acceptedMaterials))
                            </div><div class="row">
                        @endif
                    @endforeach
                </div>
                
                

            </div>
        </div>
    </section>
@endsection
