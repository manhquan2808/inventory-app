<?php

namespace App\Http\Livewire\Employee;

use App\Models\Material_input;
use Livewire\Component;

class MaterialList extends Component
{
    public function render()
    {
        return view('livewire.employee.material-list', [
            'supp_require' => Material_input::join('materials', 'materials.material_id', '=', 'material_input.material_id')
                ->join('suppliers', 'suppliers.supplier_id', '=', 'material_input.supplier_id')
                ->select(
                    'material_input.*',
                    'materials.material_name',
                    'suppliers.supplier_name',
                )
                ->where('material_input.status', '=', 'confirmed')
                ->orderBy('material_input.date', 'DESC')
                ->get()
        ]);
    }
}
