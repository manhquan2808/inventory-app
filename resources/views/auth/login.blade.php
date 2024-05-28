@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Email input -->
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-dark text-white" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">

                                {{-- <div class="mb-md-5 mt-md-4 pb-5"> --}}

                                <h2 class="fw-bold mb-2 text-uppercase">Đăng nhập</h2>
                                <p class="text-white-50 mb-5">Hãy nhập <b>Mã nhân viên</b> và <b>Mật khẩu</b> của bạn!</p>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="employee_id">Mã nhân viên</label>
                                    <input type="employee_id" id="employee_id" name="employee_id"
                                        class="form-control form-control-lg" />
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <label class="form-label" for="password">Mật khẩu</label>
                                    <input type="password" id="password" name="password"
                                        class="form-control form-control-lg" />
                                </div>
                                <br>
                                <button class="btn btn-outline-light btn-lg px-5" type="submit">Đăng nhập</button>
                                <br><br>
                                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="{{ route('request.reset') }}">Quên mật khẩu?</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </form>
    <script src="../../js/app.js"></script>
@endsection
