<?php

namespace App\Http\Controllers\production;

use App\Http\Controllers\Controller;
use App\Models\Inventory_product;
use App\Models\Product_input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CompletedDetail extends Controller
{
    public function index($id)
    {
        $completeProductDetail = Product_input::join('products', 'products.product_id', '=', 'product_input.product_id')
            ->where('product_input.input_id', '=', $id)
            ->select('product_input.input_id', 'product_input.quantity', 'products.product_name', 'products.product_id')
            ->get();
        // dd($completeProductDetail);

        foreach ($completeProductDetail as $item) {
            for ($i = 0; $i < $item->quantity; $i++) {
                $inventory_id = Session::get('inventory_id');
                Inventory_product::firstOrCreate([
                    'product_input_id' => $item->input_id,
                    'sequence' => $i + 1,
                    'inventory_id' => $inventory_id,
                    // 'reason'=>'0'
                ]);
            }
        }
        return view('production.completedDetail.index', compact('completeProductDetail'));
    }
}
