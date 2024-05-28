@push('product-table')
    <script>
        const showAddProduct = new bootstrap.Modal('#addProduct', {})
        $("#showAddProduct").on("click", () => {
            showAddProduct.show()
            $('#product_name_add').val("")
            $('#unit_add').val("")
            $('#production_cost_add').val("")
            $('.material_add').prop("checked", false)
        })
        const showDetailProduct = new bootstrap.Modal('#detailProduct', {})
        $(".showDetailProduct").on("click", () => {
            showDetailProduct.show()
        })
        const showEditProduct = new bootstrap.Modal('#editProduct', {})
        $(".showEditProduct").on("click", () => {
            showEditProduct.show()
        })
        window.addEventListener("hide-addModal", () => {
            showAddProduct.hide()

        })
        document.addEventListener('livewire:load', function() {
            // mốt mún làm gì tới js thì bỏ vô đây


        })
    </script>
@endpush
@if (Session::has('add'))
    <div class="alert alert-success">
        {{ Session::get('add') }}
    </div>
@elseif (Session::has('update'))
    <div class="alert alert-success">
        {{ Session::get('update') }}
    </div>
@elseif (Session::has('delete'))
    <div class="alert alert-success">
        {{ Session::get('delete') }}
    </div>
@endif

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
                    <button type="button" class="btn btn-primary btn me-lg-5" id="showAddProduct">Thêm
                        sản phẩm</button>
                </div>
            </div>
            <div class="overflow-x-auto d-flex justify-content-center">
                <table class="table table-striped table-dark w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase">
                        <tr class="text-light  text-center">
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Đơn vị tính</th>
                            <th>Chi phí sản xuất</th>
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
                                    <td class="px-4 py-3">{{ $product->unit }}</td>
                                    <td class="px-4 py-3">{{ $product->production_cost }}</td>
                                    <td class="px-4 py-3  flex justify-center ">
                                        <button wire:click="showDetailProduct({{ $product->product_id }})"
                                            type="button" class="btn btn-info btn-sm showDetailProduct">Xem</button>
                                        <button wire:click="editProduct({{ $product->product_id }})" type="button"
                                            class="btn btn-info btn-sm showEditProduct">Sửa</button>

                                        <button type="button" class="btn btn-sm btn-danger deleteproduct"
                                            wire:click="delProduct({{ $product->product_id }})">Xóa</button>

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
                    {{-- {{ $employees->links() }} --}}
                </div>
            </div>



        </div>
        {{-- Modal xem thông tin sản phẩm --}}
        <div class="modal fade" id="detailProduct" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true" wire:ignore.self>
            <form wire:submit.prevent="" autocomplete="off">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Xem thông tin sản phẩm
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="product_name_detail" class="col-3">Tên sản phẩm</label>
                                <div class="col-9">
                                    <input type="text" id="product_name_detail" class="form-control"
                                        wire:model.defer="product.product_name_detail" disabled>

                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="material_names_detail" class="col-3">Nguyên liệu</label>
                                <div class="col-9">
                                    <input type="text" id="material_names_detail" class="form-control"
                                        wire:model.defer="product.material_names_detail" disabled>

                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="total_cost_detail" class="col-3">Chi phí nguyên liệu (VND)</label>
                                <div class="col-9">
                                    <input type="text" id="total_cost_detail" class="form-control"
                                        wire:model.defer="product.total_cost_detail" disabled>

                                </div>
                            </div>
                            {{-- <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="production_cost_detail" class="col-3">Chi phí sản xuất</label>
                                <div class="col-9">
                                    <input type="text" id="production_cost_detail" class="form-control"
                                        wire:model.defer="product.production_cost_detail" disabled>

                                </div>
                            </div> --}}
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Đóng
                            </button>

                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Modal sửa thông tin sản phẩm --}}
        <div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true" wire:ignore.self>
            <form wire:submit.prevent="editInputProduct" autocomplete="off">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Sửa sản phẩm
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="product_id" class="col-3">Mã sản phẩm</label>
                                <div class="col-9">
                                    <input type="text" id="product_id"
                                        class="form-control @error('product_id') is-invalid @enderror"
                                        wire:model.defer="product.product_id" disabled>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="product_name" class="col-3">Tên sản phẩm</label>
                                <div class="col-9">
                                    <input type="text" id="product_name"
                                        class="form-control @error('product_name') is-invalid @enderror"
                                        wire:model.defer="product.product_name">
                                    @error('product_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    @if ($errors->has('product.product_name'))
                                        <div class="invalid-feedback">{{ $errors->first('product.product_name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="unit" class="col-3">Đơn vị tính</label>
                                <div class="col-9">
                                    <input type="text" id="unit"
                                        class="form-control @error('unit') is-invalid @enderror"
                                        wire:model.defer="product.unit">
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row has-validation" style="margin-bottom: 15px">
                                <label for="production_cost" class="col-3">Chi phí sản xuất</label>
                                <div class="col-9">
                                    <input type="text" id="production_cost"
                                        class="form-control @error('production_cost') is-invalid @enderror"
                                        wire:model.defer="product.production_cost">
                                    @error('production_cost')
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

    {{-- Modal thêm sản phẩm --}}
    <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct"
        aria-hidden="true" wire:ignore.self>
        <form wire:submit.prevent='addProduct' autocomplete="off">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitleId">
                            Thêm sản phẩm
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="product_name_add" class="col-3">Tên sản phẩm</label>
                            <div class="col-9">
                                <input type="text" id="product_name_add"
                                    class="form-control @error('product_name_add') is-invalid @enderror"
                                    wire:model.defer="product.product_name_add">
                                @error('product_name_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="unit_add" class="col-3">Đơn vị tính</label>
                            <div class="col-9">
                                <input type="text" id="unit_add"
                                    class="form-control @error('unit_add') is-invalid @enderror"
                                    wire:model.defer="product.unit_add">
                                @error('unit_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="production_cost_add" class="col-3">Chi phí sản xuất</label>
                            <div class="col-9">
                                <input type="text" id="production_cost_add"
                                    class="form-control @error('production_cost_add') is-invalid @enderror"
                                    wire:model.defer="product.production_cost_add">
                                @error('production_cost_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="material_add" class="col-3">Nguyên liệu</label>
                            <div class="col-9">
                                @foreach ($materials as $item)
                                    <input type="checkbox" name="material_input[]" class="material_add" value="{{ $item->material_id }}"
                                        wire:model.defer="material_add">
                                    {{ $item->material_name }}
                                @endforeach
                                {{-- @error('material_add') <p style="color: red">Chọn ít nhất 1 nguyên liệu</p> @enderror --}}
                            </div>
                        </div>
                        <button type="submit" class="d-flex btn btn-primary" wire:offline.attr="disabled">
                            <span wire:loading.class="disabled">Thêm</span>
                            <span wire:loading.class="loader"></span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>


</section>
