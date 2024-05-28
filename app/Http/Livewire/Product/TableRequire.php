<?php

namespace App\Http\Livewire\Product;

use App\Models\Products;
use Livewire\Component;

class TableRequire extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.product.table-require',
    [
        'products' => Products::search($this->search)
        ->select('products.product_name', 'product_order.product_id', 'product_order.quantity', 'product_order.start_date')
        ->join('product_order', 'product_order.product_id','=', 'products.product_id')
        ->orderBy('product_order.start_date',"DESC")
        ->get()
    ]);
    }
}
