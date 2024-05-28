<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function index(){
        $id = Session::get('employee_id');
        $employee = Employee::where('employee_id', $id)
            ->join('roles', 'roles.role_id', '=', 'employees.role_id')
            ->join('inventory', 'inventory.inventory_id', '=', 'employees.inventory_id')
            ->select(
                'employees.employee_id',
                'employees.email',
                'employees.number',
                'employees.birth_date',
                'inventory.inventory_name',
                'roles.role_name',
                Employee::raw("CONCAT(employees.first_name, ' ', employees.last_name) AS employee_name")
            )
            ->first();

        return view('product-management.profile.index', [
            'employee' => $employee
        ]);    }
}
