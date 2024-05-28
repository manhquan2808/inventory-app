<?php

namespace App\Http\Controllers\material;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ReceiveRequire extends Controller
{
    public $search = '';
       public function index()
    {
        return view('material-management.receive.index', [
            'products' => Products::search($this->search)
                ->select('product_order.product_id', 'product_order.status', 'product_order.quantity', 'products.product_name', 'product_order.start_date')
                ->where('product_order.status', '=', 'required')
                ->join('product_order', 'product_order.product_id', '=', 'products.product_id')
                ->orderBy('product_order.start_date', 'ASC')
                ->get()
        ]);
    }
}





//     public $material_add = [];
//     public $product = [];
//     public $search = '';
//     public $perPage = 100;
//     public $isInsert = false;
//     protected $listeners = ['some-event' => '$refresh'];

//     public function addProduct(Request $request)
//     {
//         // tập tành làm request đi 
//         foreach ($request->json()->all("updates") as $payload) {
//             if ($payload['type'] === "syncInput" && $payload["payload"]["name"] === "material_add") {
//                 $this->product[$payload["payload"]["name"]] = $payload["payload"]["value"];
//                 // dd($payload["payload"]["name"]);
//                 // array_push($products,$arrProducts);
//             }

//         }

//         $validatedData = Validator::make($this->product, [
//             "product_name_add" => 'required|string|unique:products,product_name', 
//             "unit_add" => 'required|string',
//             "production_cost_add" => 'required|numeric|min:0',
//             'material_add' => 'required'
//         ], [
//             'product_name_add.required' => 'Tên sản phẩm không được để trống.',
//             'product_name_add.unique' => 'Tên sản phẩm đã tồn tại.',
//             'unit_add.required' => 'Đơn vị tính không được để trống.',
//             'production_cost_add.required' => 'Chi phí sản xuất không được để trống.',
//             'production_cost_add.numeric' => 'Chi phí sản xuất là số nguyên.',
//             'production_cost_add.min:0' => 'Chi phí sản xuất lớn hơn 0.',
//         ])->validate();
//         $saveProduct = Products::create([
//             'product_name' => $this->product['product_name_add'],
//             'unit' => $this->product['unit_add'],
//             'production_cost' => $this->product['production_cost_add'],
//         ]);
//         if ($saveProduct->save() && isset($this->product['material_add'])) {
//             $product_id = $saveProduct->product_id;

//             foreach ($this->product['material_add'] as $material_id) {
//                 $con = mysqli_connect("localhost", "inventory", "123", "inventory_db");
//                 $this->isInsert = mysqli_query($con, "INSERT INTO `material_product`(`material_id`, `product_id`, `quantity_require`) VALUES ('$material_id','$product_id',1)");
//             }
//             if ($this->isInsert) {
//                 $this->emit('some-event');
//                 $this->dispatchBrowserEvent('hide-addModal');


//             }
//             // Session::flash('add', 'Sản phẩm đã được thêm thành công.');

//             // Material_product::create([
//             //     'product_id' => "$product_id",
//             //     'material_id' => "$material_id",
//             //     'quantity_require' => "0"
//             // ]); 
//             // $dbmaterial = new Material_product();


//             // $dbmaterial->product_id = $product_id;
//             // $dbmaterial->material_id = $material_id;
//             // $dbmaterial->save();
//         }

//     }
//     // $vaildatedMaterial = Validator::make($this->material, [
//     //     'material_add' => 'required|array', // material_add là một mảng và phải tồn tại ít nhất một phần tử
//     //     'material_add.*' => 'required',
//     // ], [
//     //     'material_add.required' => 'Tên sản phẩm không được để trống.',
//     //     'material_add.*.required' => 'Tên sản phẩm không được để trống.',
//     // ])->validate();
//     public function showDetailProduct($product_id_detail)
//     {
//         $product = Products::where('material_product.product_id', $product_id_detail)
//             ->select(
//                 'products.product_name',
//                 'material_product.product_id',
//                 'products.production_cost',
//                 Products::raw('SUM(materials.price_per_unit * material_product.quantity_require) AS total_cost'),
//                 Products::raw('GROUP_CONCAT(materials.material_name SEPARATOR ", ") AS material_names')
//             )
//             ->join('material_product', 'material_product.product_id', '=', 'products.product_id')
//             ->join('materials', 'materials.material_id', '=', 'material_product.material_id')
//             ->groupBy('products.product_name', 'material_product.product_id', 'products.production_cost')
//             ->first();

//         $this->product['product_id_detail'] = $product->product_id;
//         $this->product['product_name_detail'] = $product->product_name;
//         $this->product['material_names_detail'] = $product->material_names;
//         $this->product['total_cost_detail'] = $product->total_cost;
//         $this->product['production_cost_detail'] = $product->production_cost_detail;


//     }
//     public function editProduct($product_id)
//     {
//         $product = Products::where('product_id', $product_id)->first();
//         $this->product['product_id'] = $product->product_id;
//         $this->product['product_name'] = $product->product_name;
//         $this->product['unit'] = $product->unit;
//         $this->product['production_cost'] = $product->production_cost;


//     }
//     public function editInputProduct()
//     {

//         $validatedData = Validator::make($this->product, [
//             "product_id" => 'required',
//             "product_name" => 'required|string',
//             "unit" => 'required|string',
//             "production_cost" => 'required|numeric|min:0',

//         ], [
//             'product_id.required' => 'Tên chức vụ không được để trống.',
//             'product_name.required' => 'Tên sản phẩm không được để trống.',
//             'unit.required' => 'Đơn vị tính không được để trống.',
//             'production_cost.required' => 'Chi phí sản xuất không được để trống.',
//             'production_cost.numeric' => 'Chi phí sản xuất là số nguyên.',
//             'production_cost.min:0' => 'Chi phí sản xuất lớn hơn 0.',
//         ])->validate();
//         Products::where('product_id', $this->product['product_id'])
//             ->update([
//                 'product_id' => $this->product['product_id'],
//                 'product_name' => $this->product['product_name'],
//                 'unit' => $this->product['unit'],
//                 'production_cost' => $this->product['production_cost'],
//             ]);
//         $this->dispatchBrowserEvent('hide-product-edit');

//         Session::flash('update', 'Sản phẩm đã được sửa thành công.');
//         return redirect()->route('product-management.products');
//     }
//     public function delProduct($product_id_del)
//     {
//         Products::where('product_id', $product_id_del)->delete();
//         Session::flash('delete', 'Sản phẩm đã được xóa.');
//         return redirect()->route('product-management.products');
//     }
//     public function render()
//     {
//         return view('livewire.product.products-table',
//             [
//                 'products' => Products::search($this->search)
//                 ->select(
//                     'products.product_name',
//                     'material_product.product_id',
//                     'products.production_cost',
//                     'products.unit',
//                     Products::raw('SUM(materials.price_per_unit * material_product.quantity_require) AS total_cost'),
//                     Products::raw('GROUP_CONCAT(materials.material_name SEPARATOR ", ") AS material_names')
//                 )
//                     ->join('material_product', 'products.product_id', '=', 'material_product.product_id')
//                     ->join('materials', 'materials.material_id', '=', 'material_product.material_id')

//                     // ->orderBy($this->sortColumn, $this->sortDirection)
//                     ->groupBy('products.product_name', 'material_product.product_id', 'products.production_cost', 'products.unit')
//                     ->paginate($this->perPage), 
//                 'materials' => Materials::all(),
//             ]
//         );
//     }
// }



