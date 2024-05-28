<?php

namespace App\Http\Livewire\EmployeeProd;

use App\Models\Product_input;
use Livewire\Component;

class ProductList extends Component
{
    public function render()
    {
        return view('livewire.employee-prod.product-list',[
            'product_input' => Product_input::join('products', 'products.product_id', '=', 'product_input.product_id')
            ->where('product_input.status', 'receive')
            ->select('products.product_name', 'product_input.input_id', 'products.product_id', 'product_input.quantity', 'product_input.date')
            ->get()
        ]);
    }
}
