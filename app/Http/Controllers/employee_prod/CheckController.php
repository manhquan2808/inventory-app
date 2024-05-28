<?php

namespace App\Http\Controllers\employee_prod;

use App\Http\Controllers\Controller;
use App\Models\Product_input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckController extends Controller
{
    public function accept($id)
    {
        $product = Product_input::join('products', 'products.product_id', '=', 'product_input.product_id')
            ->join('employees', 'employees.employee_id', '=', 'product_input.employee_id')
            ->where('input_id', $id)
            ->select('product_input.*', 'products.product_name', 'employees.employee_id')
            ->first();


        if (!$product) {
            session()->flash('error_message', 'Sản phẩm không tồn tại!');
            return view('employee_prod.product_list.index');
        }

        if ($product->status === 'receive') {
            session()->flash('info_message', 'Đã nhận sản phẩm trước đó!');
            return view('employee_prod.product_list.index', [
                'product' => $product
            ]);
        }

        // Cập nhật trạng thái của sản phẩm ở nhập
        $product->status = 'receive';
        $product->save();

        session()->flash('success_message', 'Nhận sản phẩm thành công!');
        return view('employee_prod.product_list.index', ['product' => $product]);
    }
}
