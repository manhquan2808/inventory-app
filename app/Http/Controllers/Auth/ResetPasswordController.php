<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->email;

        $otp = random_int(100000, 999999);

        DB::table('employees')->where('email', $email)->update(['otp' => $otp]);

        Mail::raw("OTP của bạn là $otp", function ($message) use ($email) {
            $message->to($email)
                ->subject('OTP for Password Reset');
        });

        return redirect()->route('verify.otp.form')->with('status', 'OTP has been sent to your email.');
    }

    public function showVerifyOtpForm()
    {
        return view('auth.verify_otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['email' => 'required|email', 'otp' => 'required|numeric']);

        $email = $request->email;
        $otp = $request->otp;

        $employee = DB::table('employees')->where('email', $email)->where('otp', $otp)->first();

        if ($employee) {
            return redirect()->route('reset.form')->with('email', $email);
        }

        return back()->withErrors(['otp' => 'OTP không đúng']);
    }

    public function showResetForm(Request $request)
    {
        return view('auth.reset_password')->with('email', $request->session()->get('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            // 'email' => 'required|email',
            'password' => 'required|string|confirmed',
        ],[
            'password.confirmed' => 'Mật khẩu không trùng khớp.',
        ]);

        $email = $request->email;
        $password = $request->password;
        $pass = password_hash(base64_decode($password), PASSWORD_DEFAULT);
        DB::table('employees')->where('email', $email)->update(['password' => $pass, 'otp' => null]);

        return redirect()->route('login')->with('status', 'Password has been reset successfully.');
    }
}
