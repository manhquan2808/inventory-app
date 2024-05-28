<?php

namespace App\Http\Controllers\material;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class InventoryController extends Controller
{
    public function index(){
        $role = Session::get("role");
        return view('material-management.inventory.index',
    [
    'inventory' => Inventory::select('employees.employee_id', 'inventory.inventory_id', 'employees.role_id', 'roles.nickname')
    ->join('employees', 'employees.inventory_id', '=', 'inventory.inventory_id' )
    ->join('roles', 'roles.role_id', '=', 'employees.role_id' )
    ->where('roles.nickname', '=', $role)
    ->get()
    ]);
    }
}
