<div class="table-responsive">
    {{-- {{ $dataTable->table() }} --}}
    <table class="table table-bordered" id="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ và tên</th>
                <th></th>
            </tr>
        </thead>
    </table>

    <!-- Modal Xem -->
    <div class="modal fade" id="employee" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-dark" id="modalTitleId">
                        Thông tin nhân viên
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body body-modal text-dark"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa -->
    <div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
        <form id="editForm">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-dark" id="modalTitleId">
                            Chỉnh sửa nhân viên
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-dark edit-modal">
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="employee_id" class="col-3">ID</label>
                            <div class="col-9">
                                <input type="text" id="employee_id"
                                    class="form-control @error('employee_id') is-invalid @enderror"
                                     disabled>

                                @error('employee_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="first_name" class="col-3">Họ đệm</label>
                            <div class="col-9">
                                <input type="text" id="first_name" name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    >

                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="last_name" class="col-3">Tên</label>
                            <div class="col-9">
                                <input type="text" id="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    >

                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="email" class="col-3">Email</label>
                            <div class="col-9">
                                <input type="text" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="number" class="col-3">Số điện thoại</label>
                            <div class="col-9">
                                <input type="text" id="number"
                                    class="form-control @error('number') is-invalid @enderror"
                                    >
                                @error('number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row has-validation" style="margin-bottom: 15px">
                            <label for="birth_date" class="col-3">Ngày sinh</label>
                            <div class="col-9">
                                <input type="date" id="birth_date"
                                    class="form-control @error('birth_date') is-invalid @enderror"
                                    >
                                @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            Xác nhận
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>



</div>


@push('scripts-table')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

    <script>
        $(function() {
            const table = new DataTable("#table", {
                Processing: true,
                ServerSide: true,
                ajax: '{{ route('admin.employee.data') }}',
                dataSrc: "data",
                columns: [{
                        data: 'employee_id.',
                        className: "text-center ",
                        render: function(data) {
                            return `${data}`
                        }
                    },
                    {
                        data: null,
                        className: "text-center ",
                        render: function(data) {
                            return `${data.first_name} ${data.last_name}`
                        }
                    },
                    {
                        data: null,
                        "render": function(data, type, row, meta) {
                            // const receiptId = data;
                            const btn = `<div class="d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-info view-detail me-1" data-bs-target="#employee" data-bs-toggle="modal" data-row='${JSON.stringify(row)}'>Xem</button>
                                            <button type="button" class="btn btn-warning me-1 edit-btn" data-bs-target="#editModal" data-bs-toggle="modal" data-row='${JSON.stringify(row)}'>Sửa</button>
                                            <button type="button" class="btn btn-danger me-1 delete-btn" data-row='${JSON.stringify(row)}'>Xóa</button>

                                        </div>`
                            return btn;
                            // Combine dish names from menu_list

                        }
                    },

                ],
                language: {
                    'info': 'Trang _PAGE_ trên _PAGES_',
                    'infoEmpty': 'Không có dữ liệu !!!',
                    'infoFiltered': '(Được lọc từ _MAX_ trang)',
                    'lengthMenu': 'Hiển thị _MENU_ mục',
                    'zeroRecords': 'Không có kết quả tương ứng',
                    'search': 'Tìm kiếm:',
                },
            });
            table.on('click', '.view-detail', function(e) {
                // console.log(JSON.parse(e.target.dataset.row))
                handleModal(e.target.dataset.row)
            });
            const handleModal = (data) => {
                const json = JSON.parse(data)
                const html = `
                                    <p><strong>ID:</strong> ${json.employee_id}</p>
                                    <p><strong>Họ và tên:</strong> ${json.first_name} ${json.last_name}</p>
                                    <p><strong>Email:</strong> ${json.email}</p>
                                    <p><strong>Số điện thoại:</strong> ${json.number}</p>
                                    <p><strong>Ngày sinh:</strong> ${json.birth_date}</p>
                                    <p><strong>Chức vụ:</strong> ${json.role_name}</p>
                                    <p><strong>Tên kho:</strong> ${json.inventory_name}</p>
                                    <p><strong>Ngày tạo tài khoản:</strong> ${json.create_date}</p>
                                    <p><strong>Ngày cập nhật tài khoản:</strong> ${json.update_date}</p>
                                    `
                $('.body-modal').html(html);
            }

            // Function to handle editing modal
            function handleEditModal(rowData) {
                // console.log(rowData);
                const json = rowData
                $('#employee_id').val(json.employee_id)
                $('#first_name').val(json.first_name)
                $('#last_name').val(json.last_name)
                $('#email').val(json.email)
                // $("#selectRole option[value='" + json.role_id + "']").attr("selected", "selected");
                $('#number').val(json.number)
                $('#birth_date').val(json.birth_date)
                // $('#editInventory').val(json.inventory_id).trigger('change')
                // $('.body-modal').html(html);
                // Livewire.emit('editEmployee', rowData);
                // const editModal = document.getElementById('editModal');
               
            }
            $("#editForm").on("submit",(e)=>{
                e.preventDefault()
                const data = {
                    employee_id:$('#employee_id').val(),
                    first_name:$("#first_name").val(),
                    last_name:$("#last_name").val(),
                    email:$("#email").val(),
                    // role_id:$("#selectRole").val(),
                    number:$("#number").val(),
                    birth_date:$("#birth_date").val()
                };
                
                
                Livewire.emit('editEmployee', data);
            })
            // Event listener for "Sửa" button click
            table.on('click', '.edit-btn', function(e) {
                const rowData = JSON.parse(e.target.dataset.row);
                handleEditModal(rowData);

            });

         
        });

        // document.getElementById('employee_id').value = rowData.employee_id;
        // document.getElementById('first_name').value = rowData.first_name;
        // document.getElementById('last_name').value = rowData.last_name;
        // document.getElementById('email').value = rowData.email;
        // document.getElementById('number').value = rowData.number;
        // document.getElementById('birth_date').value = rowData.birth_date;
    </script>
@endpush
