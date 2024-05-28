@extends('employee.layouts.app')
@section('content')
    @include('employee.slidebar.slide')
    <section id="wrapper">
        @include('employee.header.index')

        <div class="p-4">
            <div class="statistics mt-4">
                <div class="row">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h1>DANH SÁCH KIỂM TRA</h1>
                        </div>
                    </div>
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
                        {{-- @if ($employees->count() > 0)
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
                        @endif --}}
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
