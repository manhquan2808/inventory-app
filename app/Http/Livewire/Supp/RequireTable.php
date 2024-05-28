<?php

namespace App\Http\Livewire\Supp;

use App\Models\Material_input;
use Livewire\Component;

class RequireTable extends Component
{

    public function acceptRequire($input_id)
    {
        $material = Material_input::find($input_id);
        $material->status = 'check';
        $material->save();

        session()->flash('success', 'Chuyển hàng thành công');
        return redirect()->route('supp.require');
    }
    public function render()
    {
        return view('livewire.supp.require-table', [
            'supp_require' => Material_input::join('materials', 'materials.material_id', '=', 'material_input.material_id')
                ->join('suppliers', 'suppliers.supplier_id', '=', 'material_input.supplier_id')
                ->select(
                    'material_input.*',
                    'materials.material_name',
                    'suppliers.supplier_name',
                )
                ->where('material_input.status', '=', 'required')
                ->get()
        ]);
    }
}
