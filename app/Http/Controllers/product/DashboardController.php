<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Inventory_material;
use App\Models\Inventory_product;
use App\Models\Material_input;
use App\Models\Materials;
use App\Models\Product_input;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function getDataFromDatabase()
    {
        $count_accept = Inventory_product::where('status', 'accept')->count();
        $count_reject = Inventory_product::where('status', 'reject')->count();

        return [
            'count_accept' => $count_accept,
            'count_reject' => $count_reject,
        ];
    }


    // public function getDataPieChart()
    // {
    //     $totalQuantity = Inventory_product::where('status', 'accept')->count();

    //     $data_pie = Inventory_product::selectRaw('COUNT(inventory_product.id) AS stock, products.product_name, products.product_id, MAX(inventory_product.last_updated) as date')
    //         ->join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
    //         ->join('products', 'products.product_id', '=', 'product_input.product_id')
    //         ->where('inventory_product.status', 'accept')
    //         ->groupBy('products.product_id', 'products.product_name')
    //         ->orderBy('inventory_product.last_updated', 'DESC')
    //         ->get();
    //     foreach ($data_pie as $material) {
    //         $material->percentage = ($material->quantity / $totalQuantity) * 100;
    //     }

    //     return $data_pie;

    // }

    public function getDataPieChart()
    {
        $totalQuantity = Inventory_product::where('status', 'accept')->count();

        $data_pie = Inventory_product::selectRaw('COUNT(inventory_product.id) AS stock, products.product_name, products.product_id, MAX(inventory_product.last_updated) as date')
            ->join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
            ->join('products', 'products.product_id', '=', 'product_input.product_id')
            ->where('inventory_product.status', 'accept')
            ->groupBy('products.product_id', 'products.product_name')
            ->orderBy('inventory_product.last_updated', 'DESC')
            ->get();

        $treemap_data = $data_pie->map(function ($material) use ($totalQuantity) {
            return [
                'x' => $material->product_name,
                'y' => $material->stock,
                'percentage' => ($material->stock / $totalQuantity) * 100
            ];
        });

        return $treemap_data;
    }


    public function getDataPieChart2()
    {
        $totalAccepted = Inventory_product::where('status', 'accept')->count();
        $totalReceivedResult = Product_input::where('status', 'receive')
            ->select(Product_input::raw("SUM(quantity) as quantity"))
            ->first();
        $totalReceived = $totalReceivedResult->quantity;

        $data = [
            [
                'product_name' => 'Accepted',
                'percentage' => ($totalReceived > 0) ? ($totalAccepted / $totalReceived) * 100 : 0
            ],
            [
                'product_name' => 'Received',
                'percentage' => ($totalReceived > 0) ? 100 - (($totalAccepted / $totalReceived) * 100) : 0
            ]
        ];

        return $data;
    }



    public function getDataLineChart()
    {
        $data_line = Material_input::join('materials', 'materials.material_id', '=', 'material_input.material_id')
            ->where('material_input.status', 'confirmed')
            ->select(DB::raw('(material_input.quantity * materials.price_per_unit) as price'), 'material_input.date')
            ->orderBy('material_input.date')
            ->get();

        // foreach ($data_line as $result) {
        //     $formatted_price = number_format($result->price, 0, ',', '.');
        // }


        return $data_line;

    }
    public function index()
    {
        $data_pie2 = $this->getDataPieChart2();
        $data = $this->getDataFromDatabase();
        $treemap_data = $this->getDataPieChart();
        $data_line = $this->getDataLineChart();
        $count_employee = Employee::where('employees.role_id', '55')->count();
        $count_product = Products::count();
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
            'product-management.dashboard.index',
            [
                'data' => $data,
                'data_pie' => $treemap_data,
                'data_line' => $data_line,
                'count_employee' => $count_employee,
                'count_require' => $count_require,
                'count_product' => $count_product,
                'data_pie2' => $data_pie2,
                'employee' => $employee,
                'count_accept' => $data['count_accept'],
                'count_reject' => $data['count_reject'],
            ]
        );
    }
}
