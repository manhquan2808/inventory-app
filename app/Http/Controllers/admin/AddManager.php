<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Inventory;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AddManager extends Controller
{
    public function showAddManager()
    {
        // if (Session::get("role")==='AD') {
        // return redirect()->route('signup');  //If user is already logged in, then redirect to dashboard page.
        return view(
            'admin.addManager.index',
            [
                'role' => Role::where('nickname', 'like', '%QL%')->get(),
                'inventory' => Inventory::whereNotIn('inventory_id', [5])->get()
            ]
        );

        // }

        // return view('signup.index');
        // return redirect('/');

    }
    public function sendEmail($email)
    {
        // Send the emai
        Mail::to($email)->send(new SendMail($email));

        return "Email sent successfully!";
    }
    public function validateEmail($email)
    {
        $apiKey = '566f93ecc9764a848e4fd1e4f573e855';
        $url = "https://emailvalidation.abstractapi.com/v1/?api_key=$apiKey&email=$email";
        $response = Http::get($url);
        return $response->json();
    }
    public function addManager(Request $request)
    {

        $validatedData = $request->validate([
            'role_id' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'number' => 'required|numeric',
            'email' => 'required|email|unique:employees,email',
            'birth_date' => 'required|date',
            'inventory_id' => 'required',
        ], [
            'role_id.required' => 'Vui lòng chọn chức vụ',
            'first_name.required' => 'Vui lòng nhập họ',
            'last_name.required' => 'Vui lòng nhập tên',
            'number.required' => 'Vui lòng nhập số điện thoại',
            'number.numeric' => 'Vui lòng nhập số điện thoại là số',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã được sử dụng',
            'birth_date.required' => 'Vui lòng nhập ngày sinh',
            'birth_date.date' => 'Ngày sinh không hợp lệ',
            'inventory_id.required' => 'Vui lòng chọn kho hàng',
        ]);
        $email = $request->input('email');
        $authEmail = $this->validateEmail($email);
        if ($authEmail['deliverability'] === "DELIVERABLE") {
            $user = DB::table('employees')
                ->where('email', $email)
                ->first();
            $pass = password_hash(base64_decode('123'), PASSWORD_DEFAULT);
            // $pass = password_hash(base64_decode($password), PASSWORD_DEFAULT);
            try {
                // $role = Role::find($request->role_id);
                $role_id = $request->input("role_id");
                $role = DB::table('roles')->select('nickname')->where('role_id', $role_id)->first();
                $nickname = $role->nickname;

                $isTrue = DB::table('employees')->insert([
                    "employee_id" => $nickname . rand(10000, 99999),
                    "role_id" => $role_id,
                    "first_name" => $request->input("first_name"),
                    "last_name" => $request->input("last_name"),
                    "number" => $request->input("number"),
                    "email" => $email,
                    "password" => $pass,
                    "birth_date" => $request->input("birth_date"),
                    "inventory_id" => $request->input("inventory_id"),
                ]);
                if ($isTrue) {
                    $this->sendEmail($email);
                    session()->flash('success', 'Tạo tài khoản thành công');
                    return redirect('/admin/accounts');
                }

            } catch (\Throwable $throwable) {
                Log::error($throwable);
                session()->flash('error', 'Có lỗi');
                // return view('signup.index');
                return redirect('/admin/accounts');
            }

        } else {
            session()->flash('error-mail', 'Mail không tồn tại');
            return redirect('/admin/addEmployee');
        }
        // $password = $request->input('password');

        // bool, underfined, null
        // if ($user) {
        //     session()->flash('error', 'Đã có tài khoản');
        //     return redirect('/admin/signUp');
        // }

    }
}
