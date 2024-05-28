@push('material-table')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addmaterial = new bootstrap.Modal(document.getElementById("addmaterial"));
            const editmaterial = new bootstrap.Modal(document.getElementById("editmaterial"));
            //     const deleteModal = new bootstrap.Modal(document.getElementById("deleteModal"));

            $("#showAddmaterial").on("click", function() {
                addmaterial.show();
                $('#material_name_add').val("")
                $('#unit_add').val("")
                $('#price_per_unit_add').val("")
            });
            window.addEventListener('hide-material-add', event => {
                addmaterial.hide();

            });

            $(".showEditmaterial").on("click", function() {
                editmaterial.show();
            });
            window.addEventListener('hide-material-edit', event => {
                editmaterial.hide();

            });
            //     $(".deleteEmployee").on("click", function() {
            //         deleteModal.show();
            //     });
        });
    </script>
@endpush
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
                    <a class="btn btn-primary btn" id="showAddmaterial" role="button">Thêm
                        nguyên liệu</a>
                </div>
            </div>

            <div class="overflow-x-auto d-flex justify-content-center">
                <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr class="text-light  text-center">
                            <th>Mã nguyên liệu</th>
                            <th>Tên nguyên liệu</th>
                            <th>Đơn vị tính</th>
                            <th>Giá mỗi đơn vị</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($materials->count() > 0)
                            @foreach ($materials as $material)
                                <tr class="border-b dark-border-gray-700 text-light text-center">
                                    <td class="px-4 py-3">{{ $material->material_id }}</td>
                                    <td class="px-4 py-3">{{ $material->material_name }}</td>
                                    <td class="px-4 py-3">{{ $material->unit }}</td>
                                    <td class="px-4 py-3">{{ $material->price_per_unit }}</td>
                                    <td class="px-4 py-3  flex justify-center ">
                                        <button wire:click="editmaterial('{{ $material->material_id }}')" type="button"
                                            class="btn btn-info btn-sm showEditmaterial">Sửa</button>
                                        <button type="button" class="btn btn-sm btn-danger deletematerial"
                                            wire:click="delmaterial({{ $material->material_id }})">Xóa</button>

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
        {{-- Modal sửa thông tin nguyên liệu --}}
        <div class="modal fade" id="editmaterial" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true" wire:ignore.self>
            <form wire:submit.prevent="editInputmaterial" autocomplete="off">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Sửa nguyên liệu
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="material_id" class="col-3">Mã nguyên liệu</label>
                                <div class="col-9">
                                    <input type="text" id="material_id"
                                        class="form-control @error('material_id') is-invalid @enderror"
                                        wire:model.defer="material.material_id" disabled>
                                    @error('material_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="material_name" class="col-3">Tên nguyên liệu</label>
                                <div class="col-9">
                                    <input type="text" id="material_name"
                                        class="form-control @error('material_name') is-invalid @enderror"
                                        wire:model.defer="material.material_name">
                                    @error('material_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($errors->has('material.material_name'))
                                        <div class="invalid-feedback">{{ $errors->first('material.material_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="unit" class="col-3">Đơn vị tính</label>
                                <div class="col-9">
                                    <input type="text" id="unit"
                                        class="form-control @error('unit') is-invalid @enderror"
                                        wire:model.defer="material.unit">
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="price_per_unit" class="col-3">Giá mỗi đơn vị</label>
                                <div class="col-9">
                                    <input type="text" id="price_per_unit"
                                        class="form-control @error('price_per_unit') is-invalid @enderror"
                                        wire:model.defer="material.price_per_unit">
                                    @error('price_per_unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"> Cập nhật
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- Modal thêm nguyên liệu --}}
    <div class="modal fade" id="addmaterial" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
        aria-hidden="true" wire:ignore.self>
        <form wire:submit.prevent="addmaterial" autocomplete="off">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Thêm nguyên liệu
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="material_name_add" class="col-3">Tên nguyên liệu</label>
                            <div class="col-9">
                                <input type="text" id="material_name_add"
                                    class="form-control @error('material_name_add') is-invalid @enderror"
                                    wire:model.defer="material.material_name_add">
                                @error('material_name_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="unit_add" class="col-3">Đơn vị tính</label>
                            <div class="col-9">
                                <input type="text" id="unit_add"
                                    class="form-control @error('unit_add') is-invalid @enderror"
                                    wire:model.defer="material.unit_add">
                                @error('unit_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="price_per_unit_add" class="col-3">Giá mỗi đơn vị</label>
                            <div class="col-9">
                                <input type="text" id="price_per_unit_add"
                                    class="form-control @error('price_per_unit_add') is-invalid @enderror"
                                    wire:model.defer="material.price_per_unit_add">
                                @error('price_per_unit_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"> Thêm
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
