<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Inventory_material;
use App\Models\Material_input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckController extends Controller
{

    // Lấy thông tin nguyên liệu
    public function accept($id)
    {
        $material = Material_input::join('materials', 'materials.material_id', '=', 'material_input.material_id')
            ->join('suppliers', 'suppliers.supplier_id', '=', 'material_input.supplier_id')
            ->where('input_id', $id)
            ->select('material_input.*', 'materials.material_name', 'suppliers.supplier_name')
            ->first();


        if (!$material) {
            session()->flash('error_message', 'Nguyên liệu không tồn tại!');
            return view('employee.material-list.index');
        }

        if ($material->status === 'confirmed') {
            session()->flash('info_message', 'Đã nhận nguyên liệu trước đó!');
            return view('employee.material-list.index', [
                'material' => $material
            ]);
        }
    

        $employee_id = Session::get('employee_id');
        $inventory_id = Employee::where('employee_id', $employee_id)->pluck('inventory_id')->first();

        // Cập nhật số lượng trong bảng inventory_material
        $inventory_material = Inventory_material::where('material_id', $material->material_id)
            ->where('inventory_id', $inventory_id)
            ->first();

        if ($inventory_material) {
            $currentQuantity = $inventory_material->quantity;
            $newQuantity = $currentQuantity + $material->quantity;
            $inventory_material->quantity = $newQuantity;
            $inventory_material->save();
        } else {
            // Nếu không tìm thấy bản ghi, tạo một bản ghi mới
            Inventory_material::create([
                'material_id' => $material->material_id,
                'inventory_id' => $inventory_id,
                'quantity' => $material->quantity
            ]);
        }

        // Cập nhật trạng thái của vật liệu
        $material->status = 'confirmed';
        $material->save();

        session()->flash('success_message', 'Nhận nguyên liệu thành công!');
        return view('employee.material-list.index', ['material' => $material]);
    }
}
