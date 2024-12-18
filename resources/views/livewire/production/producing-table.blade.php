@push('producing-table')
    <script>
        const showDetailProcess = new bootstrap.Modal('#process', {})
        $(".showDetailProcess").on("click", () => {
            showDetailProcess.show()
        })
        window.addEventListener('hide-complete', event => {
            showDetailProcess.hide();

        })
    </script>
@endpush
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
                            <th></th>
                            {{-- <th class="px-4 py-3"></th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        @if ($production->count() > 0)
                            @foreach ($production as $product)
                                <tr class="border-b dark-border-gray-700 text-light text-center">
                                    <td class="px-4 py-3">{{ $product->product_id }}</td>
                                    <td class="px-4 py-3">{{ $product->product_name }}</td>
                                    <td class="px-4 py-3">{{ $product->quantity }}</td>
                                    <td class="px-4 py-3">{{ $product->start_date }}</td>
                                    <td class="px-4 py-3  flex justify-center ">
                                        <button wire:click="showDetailProcess({{ $product->order_id }})" type="button"
                                            class="btn btn-info btn-sm showDetailProcess">Xem</button>
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

    <div class="modal fade" id="process" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <form wire:submit.prevent="complete">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId" style="color: black">
                            Danh sách nguyên liệu sản xuất <strong style="color: red">{{ $product_name }}</strong>

                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr class="text-center">
                                    <th>Tên nguyên liệu</th>
                                    <th>Đơn vị</th>
                                    <th>Số lượng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($material_list as $index => $item)
                                    <tr class="text-center">
                                        <td wire:model.defer="receives.material_name_receive">
                                            {{ $item->material_name }}
                                        </td>
                                        <td wire:model.defer="receives.unit_receive">{{ $item->unit }}</td>
                                        <td wire:model.defer="receives.quantity_receive">{{ $item->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Đóng
                        </button>
                        <button type="submit" class="btn btn-primary">Hoàn thành</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
