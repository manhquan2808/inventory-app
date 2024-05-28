<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product_order;
use App\Models\Products;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\ServiceProvider;


class RequireProdution extends Controller
{
    public function requireProdution(Request $request){
        // dd(123);
       
        $validate_ = $request->validate([
            'name' => "required|string|selected",
            'quantity'=>"required|numeric|min:1",
        ],[
            'name.required'=> 'Vui lòng chọn sản phẩm',
            // 'name.selected'=> 'Vui lòng chọn sản phẩm',
            'quantity.required'=> 'Vui lòng nhập số lượng yêu cầu ',
            'quantity.min'=> 'Số lượng yêu cầu phải lớn hơn 0',
        ]);
        $name = $request->input('name');
        $quantity = $request->input('quantity');
        $production_require = Product_order::create([
           'product_id' => $name,
           'quantity' => $quantity,
           'status' => 'required'
        ]);
        if($production_require){
            return redirect()->route('product-management.requirelist');
        }else{
            return view("errors.500");
        }

    }
    public function index()
    {
        return view('product-management.require.index',
            [
                'products' => Products::select('products.product_id', 'products.product_name')->get()
            ]
        );
    }
}
// join('product_order', 'product_order.product_id', '=', 'products.product_id')
//                     ->