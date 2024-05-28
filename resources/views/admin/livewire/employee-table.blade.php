@push('script-employee')
    <script>
        const viewModal = new bootstrap.Modal(document.getElementById("viewModal"));
        const editModal = new bootstrap.Modal(document.getElementById("editModal"));
        // const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));

        $(".showViewEmployee").on("click", function() {
            viewModal.show();
        });

        $(".showEditEmployee").on("click", function() {
            editModal.show();
        });
        window.addEventListener('hide-employee-edit', event => {
            editModal.hide();

        });
        // $(".deleteEmployee").on("click", function() {
        //     deleteModal.show();
        //     const employeeId = $(this).data("employee-id")
        //     $(".employee_id_strong").html(employeeId)
        //     // $("#submit-del").attr("wire:click",`delEmployee('${employeeId}')`)
        //     // Livewire.emit("delEmployee",employeeId)
        // });
    </script>
@endpush
<section class="mt-10">
    <div class="p-4">
        <div class="statistics mt-4">
            <div class="row">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h1>DANH SÁCH TÀI KHOẢN</h1>
                    </div>
                </div>
            </div>
        </div>
        {{-- @if (session()->has('message'))
            <div class="alert alert-success text-center">{{ session('message') }}</div>
        @endif --}}
    </div>
    <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
        <div class="bg-transparent dark:bg-gray-800 overflow-hidden">
            <div class="flex items-center justify-between p-4">
                <div class="d-flex align-items-center justify-content-between me-5">
                    <input wire:model.live="search" type="text"
                        class="bg-blue-50 border border-primary rounded-pill w-25 px-4 py-2" placeholder="Tìm kiếm">
                    {{-- <button type="button" id="openModalForm"
                        class="btn btn-sm btn-primary btn-lg py-2 ml-auto me-lg-5">Thêm
                        chức vụ</button> href="{{ route('admin.addEmployee') }}" --}}
                    <a class="btn btn-outline-primary " role="button" data-bs-toggle="modal"
                        data-bs-target="#addAccount">Thêm
                        tài khoản</a>
                </div>
            </div>

            <div class="overflow-x-auto d-flex justify-content-center">
                <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr class="text-light  text-center">
                            <th>Mã tài khoản</th>
                            <th>Họ đệm</th>
                            <th>Tên</th>
                            {{-- <th wire:click="doSort('role_id')" class="px-4 py-3">
                                <x-datatable-items :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="Mã tài khoản" />
                            </th>
                            <th wire:click="doSort('role_name')" class="px-4 py-3">
                                <x-datatable-items :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="Họ đệm" />
                            </th>
                            <th wire:click="doSort('nickname')" class="px-4 py-3">
                                <x-datatable-items :sortColumn="$sortColumn" :sortDirection="$sortDirection" columnName="Tên" />
                            </th> --}}
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($employees->count() > 0)
                            @foreach ($employees as $employee)
                                <tr class="border-b dark-border-gray-700 text-light text-center">
                                    <td class="px-4 py-3">{{ $employee->employee_id }}</td>
                                    <td class="px-4 py-3">{{ $employee->first_name }}</td>
                                    <td class="px-4 py-3">{{ $employee->last_name }}</td>
                                    <td class="px-4 py-3  flex justify-center ">
                                        <button wire:click="viewEmployee('{{ $employee->employee_id }}')" type="button"
                                            class="btn btn-info btn-sm showViewEmployee">Xem</button>
                                        <button wire:click="editEmployee('{{ $employee->employee_id }}')" type="button"
                                            class="btn btn-info btn-sm showEditEmployee">Sửa</button>
                                        <button wire:click="delEmployee('{{ $employee->employee_id }}')" type="button"
                                            class="btn btn-sm btn-danger deleteEmployee"
                                            data-employee-id="{{ $employee->employee_id }}">Xóa</button>
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

        {{-- Modal thêm tài khoản --}}


        <div class="modal fade" id="addAccount" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Chọn loại tài khoản
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="{{ route('admin.addAdmin') }}" class="btn btn-outline-primary">Admin</a>
                        <a href="{{ route('admin.addManager') }}" class="btn btn-outline-primary">Quản lý</a>
                        <a href="{{ route('admin.addEmployee') }}" class="btn btn-outline-primary">Nhân viên</a>
                        <a href="{{ route('admin.addProduction') }}" class="btn btn-outline-primary">Ban sản xuất</a>
                        {{-- <a href="{{ route('admin.addSupplier') }}" class="btn btn-outline-primary">Nhà cung cấp nguyên liệu</a> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>


        {{-- Modal xem thông tin tài khoản --}}
        <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true" wire:ignore.self>
            <form>
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Thông tin tài khoản
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="employee_id" class="col-3">Mã tài khoản</label>
                                <div class="col-9">
                                    <input type="text" id="employee_id" class="form-control"
                                        wire:model="state.employee_id" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="first_name" class="col-3">Họ đệm</label>
                                <div class="col-9">
                                    <input type="text" id="first_name" class="form-control"
                                        wire:model="state.first_name" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="last_name" class="col-3">Tên</label>
                                <div class="col-9">
                                    <input type="text" id="last_name" class="form-control"
                                        wire:model="state.last_name" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="email" class="col-3">Email</label>
                                <div class="col-9">
                                    <input type="text" id="email" class="form-control"
                                        wire:model="state.email" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="number" class="col-3">Số điện thoại</label>
                                <div class="col-9">
                                    <input type="text" id="number" class="form-control"
                                        wire:model="state.number" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="birth_date" class="col-3">Ngày sinh</label>
                                <div class="col-9">
                                    <input type="text" id="birth_date" class="form-control"
                                        wire:model="state.birth_date" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="role_name" class="col-3">Chức vụ</label>
                                <div class="col-9">
                                    <input type="text" id="role_name" class="form-control"
                                        wire:model="state.role_name" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="inventory_name" class="col-3">Kho</label>
                                <div class="col-9">
                                    <input type="text" id="inventory_name" class="form-control"
                                        wire:model="state.inventory_name" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="create_date" class="col-3">Ngày tạo tài khoản</label>
                                <div class="col-9">
                                    <input type="text" id="create_date" class="form-control"
                                        wire:model="state.create_date" disabled>
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="update_date" class="col-3">Ngày chỉnh sửa tài khoản</label>
                                <div class="col-9">
                                    <input type="text" id="update_date" class="form-control"
                                        wire:model="state.update_date" disabled>
                                </div>
                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Đóng
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    {{-- Modal sửa thông tin tài khoản --}}
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <form autocomplete="off" wire:submit.prevent="editInputEmployee">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Chỉnh sửa thông tin tài khoản
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="employee_id_edit" class="col-3">Mã tài khoản</label>
                            <div class="col-9">
                                <input type="text" id="employee_id_edit" class="form-control"
                                    wire:model.defer="state.employee_id_edit" disabled>
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="first_name_edit" class="col-3">Họ đệm</label>
                            <div class="col-9">
                                <input type="text" id="first_name_edit" class="form-control"
                                    @error('first_name_edit') is-invalid @enderror
                                    wire:model.defer="state.first_name_edit">
                                @error('first_name_edit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="last_name_edit" class="col-3">Tên</label>
                            <div class="col-9">
                                <input type="text" id="last_name_edit" class="form-control"
                                    @error('last_name_edit') is-invalid @enderror
                                    wire:model.defer="state.last_name_edit">
                                @error('last_name_edit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="email_edit" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="text" id="email_edit" class="form-control"
                                    @error('email_edit') is-invalid @enderror wire:model.defer="state.email_edit">
                                @error('email_edit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="number_edit" class="col-3">Số điện thoại</label>
                            <div class="col-9">
                                <input type="text" id="number_edit" class="form-control"
                                    @error('number_edit') is-invalid @enderror wire:model.defer="state.number_edit">
                                @error('number_edit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="birth_date_edit" class="col-3">Ngày sinh</label>
                            <div class="col-9">
                                <input type="date" id="birth_date_edit" class="form-control"
                                    @error('birth_date_edit') is-invalid @enderror
                                    wire:model.defer="state.birth_date_edit">
                                @error('birth_date_edit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="role_name_edit" class="col-3">Chức vụ</label>
                            <div class="col-9">
                                <select id="role_name_edit" class="form-control"
                                    wire:model.defer="state.role_name_edit">
                                    @foreach ($employees as $items)
                                        <option value="{{ $items->role_id }}">{{ $items->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="inventory_name_edit" class="col-3">Kho</label>
                            <div class="col-9">
                                <select id="inventory_name_edit" class="form-control"
                                    wire:model.defer="state.inventory_name_edit">
                                    @foreach ($employees as $items)
                                        <option value="{{ $items->inventory_id }}">{{ $items->inventory_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-primary"> Cập nhật
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Modal xóa tài khoản --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Xóa tài khoản
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- @foreach ($employees as $employee) --}}
                    <p>Bạn có chắc muốn xóa tài khoản <strong class="employee_id_strong"></strong>?</p>
                    {{-- @endforeach --}}
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ
                        bỏ</button>
                    <button type="button" class="btn btn-primary">Xác nhận</button>
                </div>

            </div>
        </div>
    </div>
</section>
