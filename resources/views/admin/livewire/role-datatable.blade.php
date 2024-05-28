<section class="mt-10">
    <div class="p-4">
        <div class="statistics mt-4">
            <div class="row">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h1>DANH SÁCH CHỨC VỤ</h1>
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
                    <button type="button" id="openModalForm"
                        class="btn btn-sm btn-primary btn-lg py-2 ml-auto me-lg-5">Thêm
                        chức vụ</button>
                </div>
            </div>

            <div class="overflow-x-auto d-flex justify-content-center">
                <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr class="text-light  text-center">
                            <th>STT</th>
                            <th>Tên chức vụ</th>
                            <th>Viết tắt</th>
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
                        @if ($roles->count() > 0)
                            @foreach ($roles as $role)
                                <tr class="border-b dark-border-gray-700 text-light text-center">
                                    <td class="px-4 py-3">{{ $loop->index + 1 }}</td>
                                    {{-- <td class="px-4 py-3">{{ $role->role_id }}</td> --}}
                                    <td class="px-4 py-3">{{ $role->role_name }}</td>
                                    <td class="px-4 py-3">{{ $role->nickname }}</td>
                                    <td class="px-4 py-3  flex justify-center ">
                                        <button wire:click="editMode({{ $role->role_id }})" type="button"
                                            class="btn btn-primary btn-sm showModalEdit" id="">Chỉnh
                                            sửa</button>

                                        <button wire:click="deleteRole({{ $role->role_id }})" type="button"
                                            class="btn btn-sm btn-danger showModalDel" >Xóa</button>

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
        {{-- Modal add role --}}

        <div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <form autocomplete="off" wire:submit.prevent="addRole" class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Thêm chức vụ mới
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="role_name" class="col-3">Tên chức vụ</label>
                            <div class="col-9">
                                <input type="text" id="role_name"
                                    class="form-control @error('role_name') is-invalid @enderror"
                                    wire:model.defer="state.role_name">

                                @error('role_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="nickname" class="col-3">Viết tắt</label>
                            <div class="col-9">
                                <input type="text" id="nickname"
                                    class="form-control @error('nickname') is-invalid @enderror"
                                    wire:model.defer="state.nickname">
                                @error('nickname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Thêm chức vụ
                            mới</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    {{-- Modal eidt Role --}}

    <div class="modal fade" id="editRole" tabindex="-1" 
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
        <form wire:submit.prevent="editRole" autocomplete="off">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Chỉnh sửa chức vụ
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="role_name_edit" class="col-3">Tên chức vụ</label>
                            <div class="col-9">
                                <input type="text" id="role_name_edit"
                                    class="form-control @error('role_name_edit') is-invalid @enderror"
                                    wire:model.defer="state.role_name_edit">

                                @error('role_name_edit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="nickname_edit" class="col-3">Viết tắt</label>
                            <div class="col-9">
                                <input type="text" id="nickname_edit"
                                    class="form-control @error('nickname_edit') is-invalid @enderror"
                                    wire:model.defer="state.nickname_edit">
                                @error('nickname_edit')
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


    {{-- <div class="modal fade" id="delRole" tabindex="-1"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
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
                            wire:model.defer="state.role_del_name">{{ $role->role_name }}</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button wire:click="deleteRole('{{ $role->role_id }}')" type="button" class="btn btn-primary">Xóa</button>
                </div>
            </div>
        </div>
    </div> --}}





</section>
</div>
