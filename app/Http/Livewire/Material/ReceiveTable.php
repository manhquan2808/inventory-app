<?php

namespace App\Http\Livewire\Material;

use App\Models\Inventory_material;
use App\Models\Materials;
use App\Models\Product_order;
use App\Models\Products;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ReceiveTable extends Component
{
    public $material = [];
    public $material_list = [];
    public $order_id;
    public $receives = [];
    public $search = '';

    public $materialQuantities = [];
    public $materialStocks = [];
    public function listMaterial($order_id)
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
                Product_order::raw('(CASE WHEN inventory_material.quantity IS NULL THEN 0 ELSE inventory_material.quantity END) AS stock'),
                Product_order::raw('(product_order.quantity * material_product.quantity_require) AS quantity')
            )
            ->where('product_order.order_id', $this->order_id)
            // ->where('product_order.status', '=','require')
            ->get();
        Session::put('queryResult', $queryResult);

    }

    // }
    public function accept()
    {
        $queryResult = Session::get('queryResult');
        $hasError = false;

        foreach ($queryResult as $item) {
            $quantity = $item->quantity;
            $stock = $item->stock;
            $material_id = $item->material_id;

            if ($quantity > $stock) {
                $hasError = true;
                Session::flash('error_message', 'Số lượng yêu cầu vượt quá số lượng tồn kho.');
                break;
            } else {
                $new_stock_quantity = $stock - $quantity;
                Inventory_material::where('material_id', $material_id)
                    ->update(['quantity' => $new_stock_quantity]);
            }
        }

        if ($hasError) {
            // Làm mới thành phần để hiển thị thông báo lỗi nhưng giữ nguyên dữ liệu
            $this->material_list = $queryResult;
            return;
        }

        Product_order::where('order_id', $this->order_id)
            ->update(['status' => 'receive']);


        $this->dispatchBrowserEvent('hide-accept-modal');
        // return view('material-management.receive.index');
    }
    public function render()
    {
        return view('livewire.material.receive-table', [
            'products' => Products::search($this->search)
                ->select('product_order.product_id', 'product_order.order_id', 'product_order.status', 'product_order.quantity', 'products.product_name', 'product_order.start_date')
                ->where('product_order.status', '=', 'required')
                ->join('product_order', 'product_order.product_id', '=', 'products.product_id')
                ->orderBy('product_order.start_date', 'ASC')
                ->get(),
        ]);
    }
}
// $material_receive = $this->material_list = Product_order::join('products', 'products.product_id', '=', 'product_order.product_id')
//     ->join('material_product', 'material_product.product_id', '=', 'products.product_id')
//     ->join('materials', 'materials.material_id', '=', 'material_product.material_id')
//     // ->join('inventory_material', 'materials.material_id', '=', 'inventory_material.material_id')
//     ->leftJoin('inventory_material', 'materials.material_id', '=', 'inventory_material.material_id')
//     ->select(
//         'materials.material_name',
//         'product_order.start_date',
//         'materials.unit',
//         Product_order::raw('COALESCE(inventory_material.quantity, 0) as stock'),
//         Product_order::raw('(product_order.quantity * material_product.quantity_require) AS quantity')
//     )
//     ->where('product_order.order_id', $this->order_id)
//     ->get();