@extends('admin.layouts.app')
@section('content')
    @include('admin.slidebar.slide')
    <section id="wrapper">
        @include('admin.header.index')

        <div class="p-4">
            <div class="statistics mt-4">
                <div class="row">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <h1>Thông tin</h1>
                        </div>
                    </div>
                </div>
                <section .bg-transparent>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4 shadow-lg p-3 mb-5 rounded" style="background: transparent">
                                <div class="card-body text-center bg-transparent text-white">
                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp"
                                        alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3">{{ $employee->employee_name }}</h5>
                                    <p class="text-muted mb-1">{{ $employee->role_name }}</p>
                                    <p class="text-muted mb-4">{{ $employee->inventory_name }}</p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <a class="btn btn-outline-primary  "
                                            href="{{ route('reset.form') }}" role="button"> Đổi mật
                                            khẩu</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4 shadow-lg p-3 mb-5 rounded" style="background: transparent">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Mã nhân viên</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $employee->employee_id }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Họ và tên</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $employee->employee_name }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $employee->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Số điện thoại</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $employee->number }}</p>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Ngày sinh</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $employee->birth_date }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
