<?php

namespace App\Http\Livewire\Material;

use App\Models\Material_input;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TableRequire extends Component
{
    public $search = '';
    public function render()
    {
        return view('livewire.material.table-require',

            [
                'require' => Material_input::join('materials', 'materials.material_id', '=', 'material_input.material_id')
                    ->join('suppliers', 'suppliers.supplier_id', '=', 'material_input.supplier_id')
                    ->select(
                        'material_input.*',
                        'materials.material_name',
                        'suppliers.supplier_name',
                        DB::raw("CASE
                        WHEN material_input.status = 'required' THEN 'Đã gửi yêu cầu'
                        WHEN material_input.status = 'check' THEN 'Đang kiểm tra'
                        WHEN material_input.status = 'confirmed' THEN 'Đã nhập kho'
                        ELSE 'Unknown status'
                    END AS status_text")
                    )
                    ->get()
            ]
        );
    }
}
// search($this->search)
//         ->