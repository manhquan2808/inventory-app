
<section class="mt-10">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-transparent dark:bg-gray-800 overflow-hidden">
            <div class="flex items-center justify-between p-4">
                <div class="d-flex align-items-center justify-content-between me-5">
                    {{-- <input wire:model.live="search" type="text"
                        class="bg-blue-50 border border-primary rounded-pill w-25 px-4 py-2" placeholder="Tìm kiếm"> --}}
                    {{-- <button type="button" id="openModalForm"
                        class="btn btn-sm btn-primary btn-lg py-2 ml-auto me-lg-5">Thêm
                        chức vụ</button> --}}
                    {{-- <button type="button" class="btn btn-primary btn me-lg-5">Thêm
                        yêu cầu</button> --}}
                    {{-- <a href="{{ route('product-management.require') }}" type="button" class="btn btn-outline-primary">Thêm yêu cầu</a> --}}
                </div>
            </div>
            <div class="overflow-x-auto d-flex justify-content-center">
                <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr class="text-light  text-center">
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng yêu cầu</th>
                            <th>Thời gian yêu cầu</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- <p style="color: white">{{dd($products)}}</p> --}}
                        @if ($products->count() > 0)
                            @foreach ($products as $product)
                                <tr class="border-b dark-border-gray-700 text-light text-center">
                                    <td class="px-4 py-3">{{ $product->product_id }}</td>
                                    <td class="px-4 py-3">{{ $product->product_name }}</td>
                                    <td class="px-4 py-3">{{ $product->quantity }}</td>
                                    <td class="px-4 py-3">{{ $product->start_date }}</td>
                                    <td class="px-4 py-3  flex justify-center ">
                                        <button wire:click="listMaterial({{ $product->order_id }})" type="button"
                                            class="btn btn-info btn-sm listMaterial">Xem</button>
                                        {{-- <button wire:click="listMaterial({{ $product->product_id }})" type="button"
                                            class="btn btn-info btn-sm list_material">Xem</button> --}}
                                        {{-- <button data-product-id="{{ $product->product_id }}" type="button"
                                            class="btn btn-info btn-sm list_material">Xem</button> --}}
                                        {{-- <button wire:click="editProduct({{ $product->product_id }})" type="button"
                                            class="btn btn-info btn-sm showEditProduct">Sửa</button>

                                        <button type="button" class="btn btn-sm btn-danger deleteproduct"
                                            wire:click="delProduct({{ $product->product_id }})">Xóa</button> --}}

                                    </td>
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


        </div>

    </div>
    <div class="modal fade" id="listMaterial" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <form wire:submit.prevent="accept">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Chi tiết yêu cầu
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if (session()->has('error_message'))
                            <div class="alert alert-danger">
                                {{ session('error_message') }}
                            </div>
                        @endif

                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th>Tên nguyên liệu</th>
                                    <th>Đơn vị</th>
                                    <th>Số lượng</th>
                                    <th>Tồn kho</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($material_list as $index => $item)
                                    <tr class="text-center">
                                        <td wire:model.defer="receives.material_name_receive">{{ $item->material_name }}
                                        </td>
                                        <td wire:model.defer="receives.unit_receive">{{ $item->unit }}</td>
                                        <td wire:model.defer="receives.quantity_receive">{{ $item->quantity }}</td>
                                        <td wire:model.defer="receives.stock_receive"
                                            style="color: {{ $item->stock >= $item->quantity ? 'green' : 'red' }}">
                                            {{ $item->stock }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Đóng
                        </button>
                        <button type="submit" class="btn btn-primary">Chấp nhận</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
