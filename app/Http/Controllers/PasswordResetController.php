<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PasswordResetController extends Controller
{
    public function showForgotForm()
    {
        return view('auth.passwords.forgot');
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $otp = mt_rand(100000, 999999);
        $token = Str::random(60);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            [
                'email' => $request->email,
                'token' => $token,
                'otp' => $otp,
                'created_at' => Carbon::now()
            ]
        );

        Mail::send('emails.otp', ['otp' => $otp], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Your OTP Code');
        });

        return redirect()->route('password.reset')->with(['email' => $request->email, 'token' => $token]);
    }

    public function showResetForm(Request $request)
    {
        return view('auth.passwords.reset')->with(['email' => $request->email, 'token' => $request->token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'otp' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $passwordReset = DB::table('password_resets')->where([
            ['email', $request->email],
            ['token', $request->token],
            ['otp', $request->otp]
        ])->first();

        if (!$passwordReset) {
            return back()->withErrors(['otp' => 'Invalid OTP or token.']);
        }

        $user = Employee::where('email', $request->email)->first();
        $user->password = bcrypt($request->password);
        $user->save();

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('status', 'Password has been reset!');
    }
}
