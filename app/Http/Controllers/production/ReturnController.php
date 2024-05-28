<?php

namespace App\Http\Controllers\production;

use App\Http\Controllers\Controller;
use App\Models\Inventory_product;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index()
    {
        return view('production.return.index', [
            'products' => Inventory_product::join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
                ->join('products', 'products.product_id', '=', 'product_input.product_id')
                ->where('inventory_product.status', 'reject')
                ->select(
                    'products.product_id',
                    'products.product_name',
                    'inventory_product.reason',
                    'inventory_product.last_updated',
                    'inventory_product.status',
                    'inventory_product.product_input_id',
                    'inventory_product.sequence'
                )
                ->orderBy('inventory_product.last_updated', 'desc')
                ->get()
        ]);
    }
}
