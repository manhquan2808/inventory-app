@extends('admin.layouts.app')
@section('content')
    @include('admin.slidebar.slide')
    <section id="wrapper">
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                <div class="mb-md-5 mt-md-4 pb-5">
                                    <form action="{{ route('reset.password') }}" method="POST">
                                        @csrf
                                        <h2 class="fw-bold mb-2 text-uppercase">Thay Đổi Mật Khẩu</h2>
                                        <br>
                                        @if ($errors->any())
                                            <div>
                                                @foreach ($errors->all() as $error)
                                                    <p style="color: red">{{ $error }}</p>
                                                @endforeach
                                            </div>
                                        @endif
                                        @if (session('status'))
                                            <div>
                                                <p style="color: green">{{ session('status') }}</p>
                                            </div>
                                        @endif
                                        <div class="form-outline form-white mb-4">
                                            <input type="hidden" name="email" value="{{ session('email') }}">
                                            <label class="form-label" for="password_old">Mật khẩu cũ:</label>
                                            <input type="password" id="password_old" name="password_old" required
                                                class="form-control form-control-lg">
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="password">Mật khẩu mới:</label>
                                            <input type="password" id="password" name="password" required
                                                class="form-control form-control-lg">
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="password_confirmation">Nhập lại mật khẩu:</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                required class="form-control form-control-lg">
                                        </div>
                                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Xác nhận</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    @endsection
