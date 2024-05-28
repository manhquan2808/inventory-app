<?php

namespace App\Http\Livewire\Product;

use App\Models\Inventory_product;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InventoryTable extends Component
{
    public function render()
    {
        return view('livewire.product.inventory-table', [
            'inventory' => Inventory_product::selectRaw('COUNT(inventory_product.id) AS stock, products.product_name, products.product_id, MAX(inventory_product.last_updated) as date')
                ->join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
                ->join('products', 'products.product_id', '=', 'product_input.product_id')
                ->where('inventory_product.status', 'accept')
                ->groupBy('products.product_id','products.product_name')
                ->orderBy('inventory_product.last_updated', 'DESC')
                ->get()
        ]);
    }
}
