<style>
    .table.dataTable th,
    table.dataTable td {
        color: white !important;
        align-content: left;
        text-align: left;
    }

    .modal-body .btn {
        margin: 10px 0;
        /* Thêm khoảng cách giữa các nút */
        width: 100%;
        /* Để nút rộng bằng với phần tử chứa */
    }

    .modal-body {
        text-align: center;
        /* Căn giữa các nút */
    }
</style>
@extends('admin.layouts.app')
@section('content')
    @include('admin.slidebar.slide')
    <section id="wrapper">
        @include('admin.header.index')
        @livewire('employee-table')
    @endsection

    {{-- <livewire:user-modal /> --}}
    {{-- <livewire:users-data-table /> --}}
    <script>
        // $(document).ready(function() {
        //     $('#employee-table').DataTable({
        //         "processing": true,
        //         "serverSide": true,
        //         "ajax": "{{ route('admin.employee') }}",
        //         "columns": [{
        //             "data": "employee_id"
        //         }]
        //     });
        // });
    </script>
