<?php

namespace App\Http\Controllers\production;

use App\Http\Controllers\Controller;
use App\Models\Product_input;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Completed extends Controller
{
    public function index()
    {
        $completeProduct = Product_input::join('products', 'products.product_id', '=', 'product_input.product_id')
            ->join('employees', 'employees.employee_id', '=', 'product_input.employee_id')
            ->where('product_input.status', '=', 'check')
            ->select('product_input.input_id', 'product_input.quantity', 'products.product_name', 'employees.employee_id')
            ->get();
        $qrcodes = [];
        foreach ($completeProduct as $item) {
            $url = url('/employee_prod/product/accept/' . $item->input_id);
            $qrcodes[] = QrCode::size(300)->generate($url);
        }
        return view('production.completed.index', compact('completeProduct','qrcodes'));
    }
}
