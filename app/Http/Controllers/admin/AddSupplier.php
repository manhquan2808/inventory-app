<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Role;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddSupplier extends Controller
{
    public function showAddSupplier()
    {
        // if (Session::get("role")==='AD') {
        // return redirect()->route('signup');  //If user is already logged in, then redirect to dashboard page.
        return view('admin.addSupplier.index', ['role' => Role::all()], ['inventory' => Inventory::all()]);

        // }

        // return view('signup.index');
        // return redirect('/');


    }
    public function addSupplier(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'supplier_name' => 'required',
            'number' => 'required|numeric',
            'email' => 'required',
        ], [
            'supplier_name.required' => 'Vui lòng nhập tên nhà cung cấp',
            'number.required' => 'Vui lòng nhập số điện thoại',
            'email.required' => 'Vui lòng nhập email',
            'number.numeric' => 'Vui lòng nhập số điện thoại là số'
        ]);
        $email = $request->input('email');
        // $password = $request->input('password');

        $user = Suppliers::where('email', $email)
            ->first();
        // bool, underfined, null
        if ($user) {
            session()->flash('error', 'Đã có tài khoản');
            return redirect()->route('admin.employee');
        }
        $pass = password_hash(base64_decode('123'), PASSWORD_DEFAULT);
        // $pass = password_hash(base64_decode($password), PASSWORD_DEFAULT);
        try {
            // $role = Role::find($request->role_id);
            // $role_id = $request->input("role_id");
            // $role = Role::select('nickname')->where('role_id', $role_id)->first();
            // $nickname = $role->nickname;

            $isTrue = Suppliers::insert([
                "supplier_id" => 'NCC' . rand(10000, 99999),
                "role_id" => 53,
                "supplier_name" => $request->input("supplier_name"),
                "number" => $request->input("number"),
                "email" => $email,
                "password" => $pass,

            ]);
            if ($isTrue) {
                return redirect()->route('admin.employee');

            }

        } catch (\Throwable $throwable) {
            Log::error($throwable);
            session()->flash('error', 'Có lỗi');
            // return view('signup.index');
        }

    }
}
