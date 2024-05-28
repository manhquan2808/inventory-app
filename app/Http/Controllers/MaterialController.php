<?php

namespace App\Http\Controllers;

use App\Models\Material_input;
use App\Models\Materials;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function accept($id)
    {
        // Giả sử bạn có model Material để quản lý nguyên liệu
        // $material = Materials::find($id);
        $material = Material_input::join('materials', 'materials.material_id', '=', 'material_input.material_id')
            ->join('suppliers', 'suppliers.supplier_id', '=', 'material_input.supplier_id')
            ->where('input_id', $id)
            ->select('material_input.*', 'materials.material_name', 'supplier_name')
            ->first()
        ;
        // dd($material);
        if ($material) {
            $material->status = 'Đã nhận';
            $material->save();


            return view('material.result', [
                'message' => 'Nhận hàng thành công!',
                'material' => $material
            ]);
        } else {
            return view('material.result', [
                'message' => 'Nguyên liệu không tồn tại!',
                'material' => null
            ]);
        }
    }

    // public function return($id)
    // {
    //     $material = Materials::find($id);
    //     if ($material) {
    //         $material->status = 'Trả lại';
    //         $material->save();

    //         return view('material.result', [
    //             'message' => 'Trả hàng thành công!',
    //             'material' => $material
    //         ]);
    //     } else {
    //         return view('material.result', [
    //             'message' => 'Nguyên liệu không tồn tại!',
    //             'material' => null
    //         ]);
    //     }
    // }
}
