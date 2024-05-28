<section class="mt-10">
    
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-transparent dark:bg-gray-800 overflow-hidden">
            <div class= "flex items-center justify-between p-4">
                <div class="d-flex align-items-center justify-content-between me-5">
                    <input wire:model.live="search" type="text"
                        class="bg-blue-50 border border-primary rounded-pill w-25 px-4 py-2" placeholder="Tìm kiếm">
                </div>
            </div>
        </div>
        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif

        @if (session('error_message'))
            <div class="alert alert-danger">
                {{ session('error_message') }}
            </div>
        @endif

        @if (session('info_message'))
            <div class="alert alert-danger">
                {{ session('info_message') }}
            </div>
        @endif
        <div class="overflow-x-auto d-flex justify-content-center">
            <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase">
                    <tr class="text-light  text-center">
                        <th>Mã lô hàng</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng yêu cầu</th>
                        <th>Thời gian yêu cầu</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($product_input->count() > 0)
                        @foreach ($product_input as $product)
                            <tr class="border-b dark-border-gray-700 text-light text-center">
                                <td class="px-4 py-3">{{ $product->input_id }}</td>
                                <td class="px-4 py-3">{{ $product->product_id }}</td>
                                <td class="px-4 py-3">{{ $product->product_name }}</td>
                                <td class="px-4 py-3">{{ $product->quantity }}</td>
                                <td class="px-4 py-3">{{ $product->date }}</td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" style="text-align: center"><small>Không có dữ liệu trùng
                                    khớp</small></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
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
</section>
