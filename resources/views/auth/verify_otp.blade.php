@extends('layouts.app')
<!DOCTYPE html>
<html>

<head>
    <title>Verify OTP</title>
</head>

<body>
    <h2>Xác thực OTP</h2>
    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {{-- <form action="{{ route('verify.otp') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <label for="otp">OTP:</label>
        <input type="text" id="otp" name="otp" required>
        <button type="submit">Xác thực OTP</button>
    </form> --}}
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <form action="{{ route('verify.otp') }}" method="POST">
                                    @csrf
                                    <h2 class="fw-bold mb-2 text-uppercase">Xác thực OTP</h2>
                                    <br>
                                    @if ($errors->any())
                                        <div>
                                            @foreach ($errors->all() as $error)
                                                <p style="color: red">{{ $error }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="password">Email:</label>
                                        <input type="email" id="email" name="email" required
                                            class="form-control form-control-lg">
                                    </div>
                                    <div data-mdb-input-init class="form-outline form-white mb-4">
                                        <label class="form-label" for="otp">OTP:</label>
                                        <input type="text" id="otp" name="otp" required
                                            class="form-control form-control-lg">
                                    </div>
                                    <button data-mdb-button-init data-mdb-ripple-init
                                        class="btn btn-outline-light btn-lg px-5" type="submit">Xác thực OTP</button>
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
