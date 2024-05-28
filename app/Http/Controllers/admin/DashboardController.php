<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Inventory;
use App\Models\Materials;
use App\Models\Products;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function getDataFromDatabase()
    {
        // $data = Employee::select('employee_id', 'email')->get();
        $data = Employee::join('roles', 'roles.role_id', '=', 'employees.role_id')
            ->groupBy('roles.role_name', 'roles.role_id')
            ->select('roles.role_name', 'roles.role_id', DB::raw('COUNT(*) as count'))
            ->get();
        // dd($data->toSql());


        return $data;
    }
    public function index()
    {
        $count_employee = Employee::all()->count();
        $count_role = Role::count();
        $count_inventory = Inventory::whereNotIn('inventory_id', [5])->count();
        $count_require = Products::select('product_order.product_id', 'product_order.order_id', 'product_order.status', 'product_order.quantity', 'products.product_name', 'product_order.start_date')
            ->where('product_order.status', '=', 'required')
            ->join('product_order', 'product_order.product_id', '=', 'products.product_id')
            ->count();
        $id = Session::get('employee_id');
        $employee = Employee::where('employee_id', $id)
            ->join('roles', 'roles.role_id', '=', 'employees.role_id')
            ->select(DB::raw("CONCAT(first_name, ' ', last_name) AS name"), 'roles.role_name')
            ->first();
        $data = $this->getDataFromDatabase();
        return view('admin.dashboard.index', compact('data','count_role','count_inventory','employee', 'count_employee'));

    }
}
