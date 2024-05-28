<?php

// namespace App\Http\Controllers\employee_prod;

// use App\Http\Controllers\Controller;
// use App\Models\Inventory;
// use App\Models\Inventory_product;
// use App\Models\Product_input;
// use App\Models\Products;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Session;

// class CheckDetail extends Controller
// {
//     public function index($product_id, $sequence)
//     {
//         // $not_receive = Product_input::where()
//         $inventory_product = Inventory_product::
//             join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
//             ->join('products', 'products.product_id', '=', 'product_input.product_id')
//             ->select(
//                 DB::raw("CONCAT(products.product_name, ' ', inventory_product.sequence) AS name_of_check"),
//                 'inventory_product.last_updated',
//                 // 'inventory_product.status',
//                 DB::raw("
//             CASE
//                 WHEN inventory_product.status = 'accept' THEN 'Đã nhập kho'
//                 WHEN inventory_product.status = 'reject' THEN 'Đã từ chối, hoàn hàng!'
//                 WHEN inventory_product.status = 'spending' THEN 'Đang chờ...'
//                 WHEN inventory_product.status IS NULL THEN 'Chưa kiểm tra'
//                 ELSE 'SOMETHING WRONG'
//             END AS status_label
//         ")

//             )
//             ->orderByRaw("
//         CASE
//             WHEN inventory_product.status = 'accept' THEN 1
//             WHEN inventory_product.status = 'reject' THEN 2
//             WHEN inventory_product.status = 'spending' THEN 3
//             WHEN inventory_product.status IS NULL THEN 4
//             ELSE 5
//         END
//     ")
//             ->orderBy('inventory_product.last_updated', 'DESC')
//             ->get()
//         ;
//         $product =
//             Product_input::where('product_input.input_id', $product_id)
//                 ->where('inventory_product.sequence', $sequence)
//                 ->join('products', 'products.product_id', '=', 'product_input.product_id')
//                 ->join('inventory_product', 'inventory_product.product_input_id', '=', 'product_input.input_id')
//                 ->select('products.product_name', 'products.product_id', 'product_input.date', 'product_input.input_id', 'inventory_product.sequence', 'inventory_product.is_scanned')
//                 ->get();

//         $qrcode = Inventory_product::where('product_input_id', $product_id)
//             ->where('sequence', $sequence)
//             // ->where('status', 'receive')
//             ->first();

//         if ($qrcode && !$qrcode->is_scanned) {
//             $qrcode->is_scanned = true;
//             $qrcode->status = 'spending';
//             $qrcode->save();
//         } else {
//             $productInput = Product_input::where('input_id', $product_id)->first();
//             if (!$productInput || $productInput->status !== 'receive') {
//                 session()->flash('error_message', 'QR code không hợp lệ hoặc đã được quét.');
//             }

//             return view('employee_prod.check.index', compact('sequence', 'product', 'inventory_product'));
//         }
//     }

//     public function accept(Request $request, $product_id, $sequence)
//     {
//         $input_id = $product_id;
//         $inventory_product = Inventory_product::
//             join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
//             ->join('products', 'products.product_id', '=', 'product_input.product_id')
//             ->select(
//                 DB::raw("CONCAT(products.product_name, ' ', inventory_product.sequence) AS name_of_check"),
//                 'inventory_product.last_updated',
//                 // 'inventory_product.status',
//                 DB::raw("
//         CASE
//             WHEN inventory_product.status = 'accept' THEN 'Đã nhập kho'
//             WHEN inventory_product.status = 'reject' THEN 'Đã từ chối, hoàn hàng!'
//             WHEN inventory_product.status = 'spending' THEN 'Đang chờ...'
//             WHEN inventory_product.status IS NULL THEN 'Chưa kiểm tra'
//             ELSE 'SOMETHING WRONG'
//         END AS status_label
//     ")

//             )
//             ->orderByRaw("
//     CASE
//         WHEN inventory_product.status = 'accept' THEN 1
//         WHEN inventory_product.status = 'reject' THEN 2
//         WHEN inventory_product.status = 'spending' THEN 3
//         WHEN inventory_product.status IS NULL THEN 4
//         ELSE 5
//     END
// ")
//             ->orderBy('inventory_product.last_updated', 'DESC')
//             ->get()
//         ;
//         $product =
//             Product_input::where('product_input.input_id', $product_id)
//                 ->where('inventory_product.sequence', $sequence)
//                 ->where('inventory_product.is_scanned', false)
//                 ->join('products', 'products.product_id', '=', 'product_input.product_id')
//                 ->join('inventory_product', 'inventory_product.product_input_id', '=', 'product_input.input_id')
//                 ->select('products.product_name', 'products.product_id', 'product_input.date', 'product_input.input_id', 'inventory_product.sequence')
//                 ->get();

//         $input_id = $request->input('input_id');
//         $sequence = $request->input('sequence');

//         $accept = Inventory_product::where('product_input_id', $input_id)
//             ->where('sequence', $sequence)
//             ->update(['status' => 'accept']);
//         if ($accept) {
//             session()->flash('success_message', 'Nhận sản phẩm thành công!');
//             // redirect()->route('inventory.accept');
//             $inventory_product = Inventory_product::
//                 join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
//                 ->join('products', 'products.product_id', '=', 'product_input.product_id')
//                 ->select(
//                     DB::raw("CONCAT(products.product_name, ' ', inventory_product.sequence) AS name_of_check"),
//                     'inventory_product.last_updated',
//                     // 'inventory_product.status',
//                     DB::raw("
//         CASE
//             WHEN inventory_product.status = 'accept' THEN 'Đã nhập kho'
//             WHEN inventory_product.status = 'reject' THEN 'Đã từ chối, hoàn hàng!'
//             WHEN inventory_product.status = 'spending' THEN 'Đang chờ...'
//             WHEN inventory_product.status IS NULL THEN 'Chưa kiểm tra'
//             ELSE 'SOMETHING WRONG'
//         END AS status_label
//     ")

//                 )
//                 ->orderByRaw("
//     CASE
//         WHEN inventory_product.status = 'accept' THEN 1
//         WHEN inventory_product.status = 'reject' THEN 2
//         WHEN inventory_product.status = 'spending' THEN 3
//         WHEN inventory_product.status IS NULL THEN 4
//         ELSE 5
//     END
// ")
//                 ->orderBy('inventory_product.last_updated', 'DESC')
//                 ->get()
//             ;
//             $product =
//                 Product_input::where('product_input.input_id', $product_id)
//                     ->where('inventory_product.sequence', $sequence)
//                     ->where('inventory_product.is_scanned', false)
//                     ->join('products', 'products.product_id', '=', 'product_input.product_id')
//                     ->join('inventory_product', 'inventory_product.product_input_id', '=', 'product_input.input_id')
//                     ->select('products.product_name', 'products.product_id', 'product_input.date', 'product_input.input_id', 'inventory_product.sequence')
//                     ->get();

//             return view('employee_prod.check.index', compact('product', 'inventory_product'));
//             // return redirect()->route('inventory.accept', ['product_id' => $product_id, 'sequence' => $sequence])->with(['inventory_product' => $inventory_product, 'product' => $product]);

//             // return redirect()->route('employee_prod.detail');

//         }
//         return view('employee_prod.check.index', compact('product', 'inventory_product'));
//     }
//     // return redirect()->route('employee_prod.detail');

//     //     }
//     //     // return redirect()->route('employee_prod.detail', ['product_id' => $product_id]);
//     //     // return redirect()->route('employee_prod.detail');

//     //     // return redirect()->back()->with('success', 'Sản phẩm đã được chấp nhận.');
//     // }

//     public function reject(Request $request, $product_id, $sequence)
//     {
//         // dd($sequence);
//         $reason = $request->input('reason');
//         // dd($reason);
//         $validate_reason = $request->validate([
//             'reason' => 'required',
//         ], [
//             'reason.required' => 'Vui lòng nhập lý do từ chối',
//         ]);
//         dd($validate_reason);
//         $inventory_id = Session::get('inventory_id');
//         $reject = Inventory_product::where('product_input_id', $product_id)
//             ->where('inventory_id', $inventory_id)
//             ->where('sequence', $sequence)
//             ->update(['status' => 'reject', 'reason' => $validate_reason]);

//         if ($reject) {
//             $inventory_product = Inventory_product::
//                 join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
//                 ->join('products', 'products.product_id', '=', 'product_input.product_id')
//                 ->select(
//                     DB::raw("CONCAT(products.product_name, ' ', inventory_product.sequence) AS name_of_check"),
//                     'inventory_product.last_updated',
//                     // 'inventory_product.status',
//                     DB::raw("
//             CASE
//                 WHEN inventory_product.status = 'accept' THEN 'Đã nhập kho'
//                 WHEN inventory_product.status = 'reject' THEN 'Đã từ chối, hoàn hàng!'
//                 WHEN inventory_product.status = 'spending' THEN 'Đang chờ...'
//                 WHEN inventory_product.status IS NULL THEN 'Chưa kiểm tra'
//                 ELSE 'SOMETHING WRONG'
//             END AS status_label
//         ")

//                 )
//                 ->orderByRaw("
//         CASE
//             WHEN inventory_product.status = 'accept' THEN 1
//             WHEN inventory_product.status = 'reject' THEN 2
//             WHEN inventory_product.status = 'spending' THEN 3
//             WHEN inventory_product.status IS NULL THEN 4
//             ELSE 5
//         END
//     ")
//                 ->orderBy('inventory_product.last_updated', 'DESC')
//                 ->get()
//             ;
//             $product =
//                 Product_input::where('product_input.input_id', $product_id)
//                     ->where('inventory_product.sequence', $sequence)
//                     ->where('inventory_product.is_scanned', false)
//                     ->join('products', 'products.product_id', '=', 'product_input.product_id')
//                     ->join('inventory_product', 'inventory_product.product_input_id', '=', 'product_input.input_id')
//                     ->select('products.product_name', 'products.product_id', 'product_input.date', 'product_input.input_id', 'inventory_product.sequence')
//                     ->get();

//             $input_id = $request->input('input_id');
//             $sequence = $request->input('sequence');

//             $accept = Inventory_product::where('product_input_id', $input_id)
//                 ->where('sequence', $sequence)
//                 ->update(['status' => 'accept']);
//             if ($accept) {
//                 session()->flash('success_message', 'Nhận sản phẩm thành công!');
//                 // redirect()->route('inventory.accept');
//                 $inventory_product = Inventory_product::
//                     join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
//                     ->join('products', 'products.product_id', '=', 'product_input.product_id')
//                     ->select(
//                         DB::raw("CONCAT(products.product_name, ' ', inventory_product.sequence) AS name_of_check"),
//                         'inventory_product.last_updated',
//                         // 'inventory_product.status',
//                         DB::raw("
//             CASE
//                 WHEN inventory_product.status = 'accept' THEN 'Đã nhập kho'
//                 WHEN inventory_product.status = 'reject' THEN 'Đã từ chối, hoàn hàng!'
//                 WHEN inventory_product.status = 'spending' THEN 'Đang chờ...'
//                 WHEN inventory_product.status IS NULL THEN 'Chưa kiểm tra'
//                 ELSE 'SOMETHING WRONG'
//             END AS status_label
//         ")

//                     )
//                     ->orderByRaw("
//         CASE
//             WHEN inventory_product.status = 'accept' THEN 1
//             WHEN inventory_product.status = 'reject' THEN 2
//             WHEN inventory_product.status = 'spending' THEN 3
//             WHEN inventory_product.status IS NULL THEN 4
//             ELSE 5
//         END
//     ")
//                     ->orderBy('inventory_product.last_updated', 'DESC')
//                     ->get()
//                 ;
//                 $product =
//                     Product_input::where('product_input.input_id', $product_id)
//                         ->where('inventory_product.sequence', $sequence)
//                         ->where('inventory_product.is_scanned', false)
//                         ->join('products', 'products.product_id', '=', 'product_input.product_id')
//                         ->join('inventory_product', 'inventory_product.product_input_id', '=', 'product_input.input_id')
//                         ->select('products.product_name', 'products.product_id', 'product_input.date', 'product_input.input_id', 'inventory_product.sequence')
//                         ->get();

//                 return view('employee_prod.check.index', compact('product', 'inventory_product'));

//             }
//             return view('employee_prod.check.index', compact('product', 'inventory_product'));
//         }

//     }
// }


// // ->update(['status' => 'reject', 'reason' => $request->reason]);




namespace App\Http\Controllers\employee_prod;

use App\Http\Controllers\Controller;
use App\Models\Inventory_product;
use App\Models\Product_input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CheckDetail extends Controller
{
    public function index($product_id, $sequence)
    {
        $inventory_product = Inventory_product::
            join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
            ->join('products', 'products.product_id', '=', 'product_input.product_id')
            ->select(
                DB::raw("CONCAT(products.product_name, ' ', inventory_product.sequence) AS name_of_check"),
                'inventory_product.last_updated',
                DB::raw("
                CASE
                    WHEN inventory_product.status = 'accept' THEN 'Đã nhập kho'
                    WHEN inventory_product.status = 'reject' THEN 'Đã từ chối, hoàn hàng!'
                    WHEN inventory_product.status = 'spending' THEN 'Đang chờ...'
                    WHEN inventory_product.status IS NULL THEN 'Chưa kiểm tra'
                    ELSE 'SOMETHING WRONG'
                END AS status_label
                ")
            )
            ->orderBy('inventory_product.last_updated', 'DESC')
            ->get();
        $product = Inventory_product::where('product_input_id', $product_id)
            ->where('sequence', $sequence)
            ->join('product_input', 'product_input.input_id', '=', 'inventory_product.product_input_id')
            ->join('products', 'products.product_id', '=', 'product_input.product_id')
            ->select('products.product_name', 'products.product_id', 'product_input.date', 'product_input.input_id', 'inventory_product.sequence', 'inventory_product.is_scanned', 'inventory_product.status')
            ->first();

        $qrcode = Inventory_product::where('product_input_id', $product_id)
            ->where('sequence', $sequence)
            // ->whereHas('productInput', function ($query) {
            //     $query->where('status', 'receive');
            // })
            ->select('is_scanned', 'status')
            ->first();

            $qrcode->is_scanned = true;
            $qrcode->status = 'spending';
            $qrcode->save();
        //     if ($qrcode) {
        // } else {
        //     $productInput = Product_input::where('input_id', $product_id)->first();
        //     if (!$productInput || $productInput->status !== 'receive') {
        //         session()->flash('error_message', 'QR code không hợp lệ hoặc đã được quét.');
        //         return redirect()->back();
        //     }
        //     // session()->flash('error_message', 'QR code không hợp lệ hoặc đã được quét.');
        // }

        return view('employee_prod.check.index', compact('sequence', 'product', 'inventory_product', 'qrcode'));
    }

    public function accept(Request $request, $product_id, $sequence)
    {
        $accept = Inventory_product::where('product_input_id', $product_id)
            ->where('sequence', $sequence)
            ->update(['status' => 'accept']);

        if ($accept) {
            session()->flash('success_message', 'Nhận sản phẩm thành công!');
        }

        return redirect()->route('employee_prod.detail', ['product_id' => $product_id, 'index' => $sequence]);
    }

    public function reject(Request $request, $product_id, $sequence)
    {
        $validate_reason = Validator::make($request->all(), [
            'reason' => 'required|max:255',
        ], [
            'reason.required' => 'Vui lòng nhập lý do từ chối',
        ]);

        if ($validate_reason->fails()) {
            return redirect()->back()->withErrors($validate_reason)->withInput();
        }

        $reason = $request->input('reason');
        $reject = Inventory_product::where('product_input_id', $product_id)
            ->where('sequence', $sequence)
            ->update(['status' => 'reject', 'reason' => $reason]);

        if ($reject) {
            session()->flash('success_message', 'Từ chối sản phẩm thành công!');
        }

        return redirect()->route('employee_prod.detail', ['product_id' => $product_id, 'index' => $sequence]);
    }
}

