@push('inventory-table')
    <script>
        // INVENTORY
        const modalAddInventory = new bootstrap.Modal(document.getElementById("addInventory"), {})
        $("#openAddEmployee").on('click', event => {
            modalAddInventory.show();
            $('#inventory_name').val("")
            $('#address').val("")

        })
        window.addEventListener('hide-add-employee', event => {
            modalAddInventory.hide();

        })

        const modalEditInventory = new bootstrap.Modal(document.getElementById("editInventory"), {})
        $(".showInventoryEdit").on('click', event => {
            modalEditInventory.show();

        })
        window.addEventListener('hide-edit-employee', event => {
            modalEditInventory.hide();

        })

        // const modalDelInventory = new bootstrap.Modal(document.getElementById("delInventory"), {})
        // $(".showInventoryDel").on('click', event => {
        //     modalDelInventory.show();

        // })
    </script>
@endpush
<section class="mt-10">
    <div class="p-4">
        <div class="statistics mt-4">
            <div class="row">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h1>DANH SÁCH KHO</h1>
                    </div>
                </div>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success text-center">{{ session('message') }}</div>
        @endif
    </div>
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-transparent dark:bg-gray-800 overflow-hidden">
            <div class="flex items-center justify-between p-4">
                <div class="d-flex align-items-center justify-content-between me-5">
                    <input wire:model.live="search" type="text"
                        class="bg-blue-50 border border-primary rounded-pill w-25 px-4 py-2" placeholder="Tìm kiếm">
                    <button type="button" id="openAddEmployee"
                        class="btn btn-sm btn-primary btn-lg py-2 ml-auto me-lg-5">Thêm
                        kho</button>
                </div>
            </div>

            <div class="overflow-x-auto d-flex justify-content-center">
                <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr class="text-light  text-center">
                            <th>STT</th>
                            <th>Tên kho</th>
                            <th>Địa chỉ</th>
                            <th>Loại kho</th>
                            {{-- 
                            <th wire:click="doSort('role_id')" class="px-4 py-3">
                                <x-datatable-items :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="STT" />
                            </th>
                            <th wire:click="doSort('role_name')" class="px-4 py-3">
                                <x-datatable-items :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="Tên chức vụ" />
                            </th>
                            <th wire:click="doSort('nickname')" class="px-4 py-3">
                                <x-datatable-items :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="Viết tắt" />
                            </th> --}}
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($inventory->count() > 0)
                            @foreach ($inventory as $item)
                                <tr class="border-b dark-border-gray-700 text-light text-center">
                                    <td class="px-4 py-3">{{ $loop->index + 1 }}</td>
                                    {{-- <td class="px-4 py-3">{{ $item->item_id }}</td> --}}
                                    <td class="px-4 py-3">{{ $item->inventory_name }}</td>
                                    <td class="px-4 py-3">{{ $item->address }}</td>
                                    <td class="px-4 py-3">{{ $item->type_name }}</td>
                                    <td class="px-4 py-3  flex justify-center ">
                                        <button wire:click="showEditInventory({{ $item->inventory_id }})" type="button"
                                            class="btn btn-primary btn-sm showInventoryEdit" id="">Chỉnh
                                            sửa</button>

                                        <button wire:click="deleteInventory({{ $item->inventory_id }})" type="button"
                                            class="btn btn-sm btn-danger showInventoryDel">Xóa</button>

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
            <div class="py-4 px-3">
                <div class="flex">
                    <div class="flex space-x-4 items-center mb-3">
                        <label class="text-white">Số trang</label>
                        <select wire:model.live="perPage">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                {{-- {{ $roles->links() }}   --}}
            </div>
        </div>
        {{-- Modal add inventory --}}

        <div class="modal fade" id="addInventory" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <form autocomplete="off" wire:submit.prevent="addInventory" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Thêm kho mới
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="inventory_name" class="col-3">Tên kho</label>
                            <div class="col-9">
                                <input type="text" id="inventory_name"
                                    class="form-control @error('inventory_name') is-invalid @enderror"
                                    wire:model.defer="state.inventory_name">

                                @error('inventory_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="address" class="col-3">Địa chỉ</label>
                            <div class="col-9">
                                <input type="text" id="address"
                                    class="form-control @error('address') is-invalid @enderror"
                                    wire:model.defer="state.address">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="type_id" class="col-3">Loại kho</label>
                            <div class="col-9">
                                <select id="type_id" class="form-control" wire:model.defer="state.type_id">
                                    <option value="">Chọn loại kho</option>
                                    @foreach ($inventory_type as $item)
                                        <option value="{{ $item->type_id }}">{{ $item->type_name }}</option>
                                    @endforeach
                                </select>
                                @error('type_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Thêm kho
                            mới</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Modal edit inventory --}}

    <div class="modal fade" id="editInventory" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <form autocomplete="off" wire:submit.prevent="editInventory">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Chỉnh sửa kho
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="inventory_name_edit" class="col-3">Tên kho</label>
                            <div class="col-9">
                                <input type="text" id="inventory_name_edit"
                                    class="form-control @error('inventory_name_edit') is-invalid @enderror"
                                    wire:model.defer="state.inventory_name_edit">

                                @error('inventory_name_edit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="address_edit" class="col-3">Địa chỉ</label>
                            <div class="col-9">
                                <input type="text" id="address_edit"
                                    class="form-control @error('address_edit') is-invalid @enderror"
                                    wire:model.defer="state.address_edit">
                                @error('address_edit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Xác
                            nhận sửa</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Modal delete inventory --}}
    {{-- <div class="modal fade" id="delInventory" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <form action="" >
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Xóa chức vụ
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Bạn có muốn xóa chức vụ <strong wire:model.defer="state.inventory_name_del"></strong>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Đóng
                        </button>
                        <button wire:click="deleteInventory({{ $inventory->inventory_id }})" type="submit"
                            class="btn btn-primary">Xóa</button>
                    </div>
                </div>
            </div>
        </form>
    </div> --}}

    {{-- <div class="modal fade" id="delInventory" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Xóa chức vụ
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Bạn có muốn xóa chức vụ <strong
                            wire:model.defer="state.inventory_name_del">{{ $inventory->inventory_name }}</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button wire:click="deleteInventory('{{ $inventory->inventory_id }}')" type="button"
                        class="btn btn-primary">Xóa</button>
                </div>
            </div>
        </div>
    </div> --}}





</section>
</div>
{{-- {{ $inventory->inventory_name }} 
wire:click="deleteInventory('{{ $inventory->inventory_id }}')" 
--}}
