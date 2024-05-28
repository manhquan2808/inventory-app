<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Auth\Employee;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Suppliers;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
// use phpseclib3\Crypt\RSA;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class LoginController extends Controller
{
    //get - read
    public function showLoginForm()
    {

        if (Session::get("role") === "AD") {
            return Redirect::route('admin.dashboard'); //If employee is already logged in, then redirect to dashboard page.
        } elseif (Session::get("role") === "NVNL") {
            return Redirect::route('employee'); //If employee is already logged in, then redirect to dashboard page.
        } elseif (Session::get("role") === "QLNL") {
            return Redirect::route('material-management.dashboard');
        } elseif (Session::get("role") === "QLTP") {
            return Redirect::route('product-management.dashboard');
        } elseif (Session::get("role") === "NCC") {
            return Redirect::route('supp.dashboard');
        } elseif (Session::get("role") === "SX") {
            return Redirect::route('production');
        } elseif (Session::get("role") === "NVSP") {
            return Redirect::route('employee_prod');
        }
        return view('auth.login');
        // return redirect()->route('dashboard');

    }
    //post http body {data} -> tạo mới dữ liệu
    //put http body {data} -> cập nhật lại
    // CRUD
    public function login(Request $request)
    {

        // $credential = $request->only(["email","password"]);
        $employee_id = $request->input('employee_id');
        $password = $request->input('password');
        // Truy vấn kiểm tra dữ liệu -- post model
        $employee = Employee::where('employee_id', $employee_id)->first();
        $inventory = Employee::where('inventory_id', $employee_id)->first();
        // var_dump($employee->$id);

        $supplier = Suppliers::where('email', $employee_id)->first();

        // Kiểm tra tồn tại của employee và so sánh Password
        if ($employee && Hash::check(base64_decode($password), $employee->password)) {

            $role_id = Employee::find($employee->employee_id, "role_id")->role_id;
            $nickNameSession = Role::find($role_id, "nickname")->nickname;
            Session::put("role", $nickNameSession);
            $employeeId = $employee->employee_id;
            Session::put("employee_id", $employeeId);

            $inventory_id = $employee->inventory_id;
            Session::put("inventory_id", $inventory_id);

            // $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

            // Chuyển hướng đến trang dashboard
            if ($nickNameSession === "AD") {
                return redirect()->intended("admin/dashboard");
            } elseif ($nickNameSession === "NVNL") {
                return redirect()->intended("employee");
            } elseif ($nickNameSession === "QLNL") {
                return redirect()->intended("material-management/dashboard");
            } elseif ($nickNameSession === "QLTP") {
                return redirect()->intended("product-management/dashboard");
            } elseif ($nickNameSession === "SX") {
                return redirect()->intended("production");
            } elseif ($nickNameSession === "NVSP") {
                return redirect()->intended("employee_prod");
            }

        } elseif ($supplier && Hash::check(base64_decode($password), $supplier->password)) {
            $role_id = $supplier->role_id;
            $nickNameSession = Role::find($role_id, "nickname")->nickname;
            Session::put("role", $nickNameSession);
            if ($nickNameSession === "NCC") {
                return redirect()->intended("supp/dashboard");
            }
        } else {
            // Đăng nhập thất bại 
            session()->flash('error', 'Sai thông tin đăng nhập. Vui lòng thử lại!');
            return back()->withInput()->withErrors(['email' => 'Thông tin đăng nhập không đúng']);
            // return redirect()->intended("/test")->with('error', 'Đăng nhập thất bại');
        }
        // if(!auth()->attempt($credential)){
        //     return back()->withInput()->withErrors(["error" => "Thông tin sai!!!"]);
        // }
        // return  redirect("/dashboard")->with(["success"=>""]);
    }
    public function LogOut(Request $request)
    {
        // Auth::logout();
        Session::forget("role");
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Bạn đã đăng xuất thành công !!!');
    }
    protected function redirectTo()
    {
        if (Auth::check()) {
            return route('dashboard.index'); // hoặc route('home')
        }
    }
}
