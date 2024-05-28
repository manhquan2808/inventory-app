<?php

namespace App\Http\Controllers\material;

use App\Http\Controllers\Controller;
use App\Models\Material_input;
use App\Models\Materials;
use App\Models\Suppliers;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class RequireMaterial extends Controller
{
    public function requireMaterial(Request $request)
    {
        $name = $request->input('name');
        $supplier = $request->input('supplier');
        $quantity = $request->input('quantity');
        // Validated
        $validated = $request->validate(
            [
                'name' => "required|string|selected",
                'supplier' => "required|string|selected",
                'quantity' => "required|numeric|min:1",
            ],
            [
                'name.required' => 'Vui chọn nguyên liệu',
                'supplier.required' => 'Vui chọn nhà cung cấp',
                'name.selected' => 'Vui chọn nguyên liệu',
                'quantity.required' => 'Vui lòng nhập số lượng nhập nguyên liệu',
                'name.numeric' => 'Vui lòng chỉ nhập số',
                'name.min' => 'Số lượng lớn hơn 0',
            ]
        );
        $require_material = Material_input::insert([
            'material_id' => $name,
            'supplier_id' => $supplier,
            'quantity' => $quantity,
            'status' => 'required'
        ]);
        if ($require_material) {
            session()->flash('success', 'Yêu cầu nhập nguyên liệu đã được gửi.');
            return redirect()->route('material-management.require');
        }

    }
    public function index()
    {
        return view('material-management.require.index',
            [
                'materials' => Materials::select('materials.material_id', 'materials.material_name')->get(),
                'suppliers' => Suppliers::select('suppliers.supplier_id', 'suppliers.supplier_name')->get()
            ]
        );
    }
}
