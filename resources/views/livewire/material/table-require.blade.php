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
                        <a href="{{ route('material-management.require') }}" type="button" class="btn btn-outline-primary">Thêm yêu cầu</a>
                </div>
            </div>
            <div class="overflow-x-auto d-flex justify-content-center">
                <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr class="text-light  text-center">
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Nhà cung cấp</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Thời gian yêu cầu</th>
                            {{-- <th class="px-4 py-3"></th> --}}
                        </tr>
                    </thead>
                    <tbody>

                        {{-- <p style="color: white">{{dd($materials)}}</p> --}}
                        @if ($require->count() > 0)
                            @foreach ($require as $value)
                                <tr class="border-b dark-border-gray-700 text-light text-center">
                                    <td class="px-4 py-3">{{ $value->material_id }}</td>
                                    <td class="px-4 py-3">{{ $value->material_name }}</td>
                                    <td class="px-4 py-3">{{ $value->supplier_name }}</td>
                                    <td class="px-4 py-3">{{ $value->quantity }}</td>
                                    <td class="px-4 py-3">{{ $value->status_text }}</td>
                                    <td class="px-4 py-3">{{ $value->date }}</td>
                                    {{-- <td class="px-4 py-3  flex justify-center ">
                                        <button wire:click="showDetailmaterial({{ $material->material_id }})"
                                            type="button" class="btn btn-info btn-sm showDetailmaterial">Xem</button>
                                        <button wire:click="editmaterial({{ $material->material_id }})" type="button"
                                            class="btn btn-info btn-sm showEditmaterial">Sửa</button>

                                        <button type="button" class="btn btn-sm btn-danger deletematerial"
                                            wire:click="delmaterial({{ $material->material_id }})">Xóa</button>

                                    </td> --}}
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
                    {{-- {{ $employees->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</section>
