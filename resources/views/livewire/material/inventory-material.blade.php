<section class="mt-10">
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-transparent dark:bg-gray-800 overflow-hidden">
            <div class="flex items-center justify-between p-4">
                <div class="d-flex align-items-center justify-content-between me-5">
                    <input wire:model.live="search" type="text"
                        class="bg-blue-50 border border-primary rounded-pill w-25 px-4 py-2" placeholder="Tìm kiếm">
                    {{-- <button type="button" id="openModalForm"
                        class="btn btn-sm btn-primary btn-lg py-2 ml-auto me-lg-5">Thêm
                        chức vụ</button> --}}
                    {{-- <button type="button" class="btn btn-primary btn me-lg-5">Thêm
                        yêu cầu</button> --}}
                    <a href="{{ route('material-management.require') }}" type="button"
                        class="btn btn-outline-primary">Nhập nguyên liệu</a>
                </div>
            </div>

            <div class="overflow-x-auto d-flex justify-content-center">
                <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr class="text-light  text-center">
                            <th>Tên nguyên liệu</th>
                            {{-- <th>Tên sản phẩm</th> --}}
                            <th>Tồn kho</th>
                            <th>Thời gian cập nhật</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- <p style="color: white">{{dd($products)}}</p> --}}
                        @if ($materials->count() > 0)
                            @foreach ($materials as $material)
                                <tr class="border-b dark-border-gray-700 text-light text-center">
                                    {{-- <td class="px-4 py-3">{{ $material->material_id }}</td> --}}
                                    <td class="px-4 py-3">{{ $material->material_name }}</td>
                                    {{-- <td class="px-4 py-3">{{ $material->inventory_name }}</td> --}}
                                    <td class="px-4 py-3">{{ $material->quantity }}</td>
                                    <td class="px-4 py-3">{{ $material->last_updated }}</td>
                                    <td class="px-4 py-3  flex justify-center ">
                                        {{-- <button wire:click="showDetailProduct({{ $product->product_id }})"
                                            type="button" class="btn btn-info btn-sm showDetailProduct">Xem</button>
                                        <button wire:click="editProduct({{ $product->product_id }})" type="button"
                                            class="btn btn-info btn-sm showEditProduct">Sửa</button>

                                        <button type="button" class="btn btn-sm btn-danger deleteproduct"
                                            wire:click="delProduct({{ $product->product_id }})">Xóa</button> --}}

                                    </td>
                                </tr>
                            @endforeach
                        {{-- @elseif($material_0->count() > 0)
                            @foreach ($material_0 as $item)
                                <tr>
                                    <td class="px-4 py-3">{{ $item->material_name }}</td>
                                    <td class="px-4 py-3">0</td>
                                    <td class="px-4 py-3">Chưa cập nhật</td>
                                    <td></td>
                                </tr>
                            @endforeach --}}
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
                    {{-- {{ $employees->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</section>
