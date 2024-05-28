<?php

namespace App\Http\Livewire\Production;

use App\Models\Inventory_product;
use App\Models\Product_input;
use App\Models\Product_order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProducingTable extends Component
{

    public $material_list = [];
    public $product_name;

    public $order_id;
    public function showDetailProcess($order_id)
    {
        $this->order_id = $order_id;

        $queryResult = $this->material_list = Product_order::join('products', 'products.product_id', '=', 'product_order.product_id')
            ->join('material_product', 'material_product.product_id', '=', 'products.product_id')
            ->join('materials', 'materials.material_id', '=', 'material_product.material_id')
            ->leftJoin('inventory_material', 'materials.material_id', '=', 'inventory_material.material_id')
            ->select(
                'materials.material_name',
                'product_order.start_date',
                'inventory_material.material_id',
                'materials.unit',
                'product_order.product_id',
                'product_order.quantity AS quantity_of_order',
                DB::raw('(product_order.quantity * material_product.quantity_require) AS quantity'),
            )
            ->where('product_order.order_id', $order_id)
            ->where('product_order.status', 'receive')
            ->get();
        $this->product_name = Product_order::where('order_id', $order_id)
            ->join('products', 'products.product_id', '=', 'product_order.product_id')
            ->select('products.product_name')->first()->product_name;
        $product_id = $queryResult->first()->product_id;
        $quantity_of_order = $queryResult->first()->quantity_of_order;
        Session::put('queryResult', ['product_id' => $product_id, 'quantity_of_order' => $quantity_of_order]);

    }

    public function complete()
    {
        $queryResult = Session::get('queryResult');
        $product_id = $queryResult['product_id'];
        $quantity = $queryResult['quantity_of_order'];
        // $inventory_id = Session::get('inventory_id');
        $employee_id = Session::get('employee_id');
        // dd($employee_id);
        $product_input = Product_input::create([
            'employee_id' => $employee_id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'status' => 'check'
        ]);
        // $inventory_id = $inventory['inventory_id'];
        Product_order::where('order_id', $this->order_id)->update(['status' => 'complete']);


        if ($product_input) {
            session()->flash('product_success', 'Sản xuất và chuyển hàng thành công');
            $this->dispatchBrowserEvent('hide-commplete');
            return redirect()->route('production.producing');

        }
    }
    public function render()
    {
        return view('livewire.production.producing-table', [
            'production' => Product_order::join('products', 'products.product_id', '=', 'product_order.product_id')
                ->where('product_order.status', '=', 'receive')
                ->select('products.product_id', 'product_order.order_id', 'products.product_name', 'product_order.quantity', 'product_order.start_date')
                ->get(),

        ]);
    }
}
