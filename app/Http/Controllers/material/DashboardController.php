<?php

namespace App\Http\Controllers\material;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Inventory_material;
use App\Models\Material_input;
use App\Models\Materials;
use App\Models\Product_order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function getDataFromDatabase()
    {
        $data = Material_input::select(
            'material_input.quantity as material_input_quantity',
            'product_order.quantity as product_order_quantity',
            'material_input.date as material_input_date',
            'material_input.input_id',
            'product_order.order_id'
        )
            ->join('material_product', 'material_input.material_id', '=', 'material_product.material_id')
            ->join('product_order', 'material_product.product_id', '=', 'product_order.product_id')
            ->where('material_input.status', 'confirmed')
            ->where(function ($query) {
                $query->where('product_order.status', 'receive')
                    ->orWhere('product_order.status', 'complete');
            })
            ->get();


        return $data;
    }

    public function getDataPieChart()
    {
        $totalQuantity = Inventory_material::sum('quantity');
        $data_pie = Inventory_material::join('materials', 'materials.material_id', '=', 'inventory_material.material_id')
            ->select('materials.material_name', 'inventory_material.quantity')
            ->get();
        foreach ($data_pie as $material) {
            $material->percentage = ($material->quantity / $totalQuantity) * 100;
        }

        return $data_pie;

    }

    public function getDataLineChart()
    {
        $data_line = Material_input::join('materials', 'materials.material_id', '=', 'material_input.material_id')
            ->where('material_input.status', 'confirmed')
            ->select(DB::raw('(material_input.quantity * materials.price_per_unit) as price'), 'material_input.date')
            ->orderBy('material_input.date')
            ->get();

        foreach ($data_line as $result) {
            $formatted_price = number_format($result->price, 0, ',', '.');
        }


        return $data_line;

    }
    public function index()
    {
        $data = $this->getDataFromDatabase();
        $data_pie = $this->getDataPieChart();
        $data_line = $this->getDataLineChart();
        $count_employee = Employee::where('employees.role_id', '54')->count();
        $count_material = Materials::count();
        $count_require = Products::select('product_order.product_id', 'product_order.order_id', 'product_order.status', 'product_order.quantity', 'products.product_name', 'product_order.start_date')
            ->where('product_order.status', '=', 'required')
            ->join('product_order', 'product_order.product_id', '=', 'products.product_id')
            ->count();
        $id = Session::get('employee_id');
        $employee = Employee::where('employee_id', $id)
            ->join('roles', 'roles.role_id', '=', 'employees.role_id')
            ->select(DB::raw("CONCAT(first_name, ' ', last_name) AS name"), 'roles.role_name')
            ->first();
        return view(
            'material-management.dashboard.index',
            compact('data', 'data_pie', 'data_line', 'count_employee', 'count_require', 'count_material', 'employee')
        );
    }
}
