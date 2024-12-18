@extends('layouts.app')
<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
</head>

<body>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form action="{{ route('request.reset') }}" method="POST">
                                    @csrf
                                    <h2 class="fw-bold mb-2 text-uppercase">Đổi Mật Khẩu</h2>
                                    <br>
                                    @if (session('status'))
                                        <div>
                                            {{ session('status') }}
                                        </div>
                                    @endif
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="password">Email:</label>
                                        <input type="email" id="email" name="email" required
                                            class="form-control form-control-lg">
                                    </div>

                                    <button data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-outline-light btn-lg px-5" type="submit">Gửi OTP</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</body>

</html>
