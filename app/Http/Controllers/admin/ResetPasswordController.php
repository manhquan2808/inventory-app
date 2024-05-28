<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    public function index()
    {
        return view('admin.resetpassword.index');
    }
    public function resetPassword(Request $request)
    {
        // Validate input
        $request->validate(
            [
                // 'email' => 'required|email',
                'password_old' => 'required|string',
                'password' => 'required|string|confirmed',
            ],
            [
                'password.confirmed' => 'Mật khẩu không trùng khớp',
            ]
        );

        // Fetch user by email
        // $user = DB::table('employees')->where('email', $request->email)->first();
        $user_id = Session::get('employee_id');
        $user = Employee::find($user_id);

        if (!$user) {
            return back()->withErrors(['email' => 'Phải đăng nhập vào hệ thống.']);
        }

        // Check if the old password matches
        $password = $request->password_old;
        if (empty($password)) {
            return back()->withErrors(['password_old' => 'Mật khẩu cũ không được để trống.']);
        }

        if (!Hash::check(base64_decode($password), $user->password)) {
            return back()->withErrors(['password_old' => 'Mật khẩu cũ không đúng.']);
        }

        // Update the user's password
        $password_new = $request->password;
        $pass = password_hash(base64_decode($password_new), PASSWORD_DEFAULT);
        // Decode the new password
        $decodedPassword = base64_decode($request->password);

        // Hash the new password
        $hashedPassword = Hash::make($decodedPassword);
        Employee::where('employee_id', $user)->update([
            'password' => $hashedPassword,
        ]);

        return redirect()->route('login')->with('status', 'Mật khẩu đã được thay đổi thành công.');
    }
}
