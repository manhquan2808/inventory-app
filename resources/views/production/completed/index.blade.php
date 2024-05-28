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
                            <h1>Sản Phẩm Đã Hoàn Thành</h1>
                        </div>
                    </div>

                </div>



                <div class="row">
                    @foreach ($completeProduct as $index => $item)
                        <div class="col-md-4 mb-3">
                            <a class="card h-100" href="completed/{{ $item->input_id }}" style="width: 350px; background-color: dimgray; text-decoration: none; color: white;">
                                <div class="card-body">
                                    <div class="text-center d-flex flex-column">
                                        <div class="qrcode" id="qrcode{{ $index }}">
                                            {!! $qrcodes[$index] !!}
                                        </div>
                                    </div>
                                    <div class="product-info mt-4">
                                        <h2 class="card-title">Tên sản phẩm: {{ $item->product_name }}</h2>
                                        <p class="card-text">Số lượng: {{ $item->quantity }}</p>
                                        <p class="card-text">Nhân viên sản xuất: {{ $item->employee_id }}</p>
                                    </div>
                                </div>
                                {{-- <div class="qr-codes-container" id="qrCodesContainer{{ $index }}"
                                    style="display: none;">
                                    <!-- Nơi chứa QR code khi click vào card -->
                                </div> --}}
                            </a>
                        </div>
                        @if (($index + 1) % 3 == 0 && $index + 1 < count($completeProduct))
                </div>
                <div class="row">
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    {{-- <script>
        function showQRCodes(productId, quantity, index) {
            let container = document.getElementById('qrCodesContainer' + index);
            if (container.style.display === 'none') {
                container.style.display = 'block';
                container.innerHTML = ''; // Xóa mã QR hiện tại

                for (let i = 0; i < quantity; i++) {
                    let qrCode = document.createElement('div');
                    qrCode.className = 'qrcode-item';
                    qrCode.innerHTML = `{!! QrCode::size(150)->generate('${url(' / product / ')}/' + productId + '/' + (i + 1)) !!}`;
                    container.appendChild(qrCode);
                }
            } else {
                container.style.display = 'none';
            }
        }
    </script> --}}
@endsection
