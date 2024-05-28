<?php

namespace App\Http\Livewire\Material;

use App\Models\Inventory_material;
use App\Models\Materials;
use Livewire\Component;

class InventoryMaterial extends Component
{
    // public $search = '';
    public function render()
    {
        return view('livewire.material.inventory-material',
    [
        'materials' => Inventory_material::
        join('inventory', 'inventory.inventory_id', '=', 'inventory_material.inventory_id')
        ->join('materials', 'materials.material_id', '=', 'inventory_material.material_id')
        ->select('inventory.inventory_name', 'inventory_material.quantity', 'materials.material_name', 'materials.material_id',  'inventory_material.last_updated')
        ->get(),
        // 'material_0' => Materials::leftJoin('inventory_material', 'materials.material_id', '=', 'inventory_material.material_id')
        // ->whereNull('inventory_material.material_id')
        // ->select('materials.material_id', 'materials.material_name')
        // ->get()
    ]);
    }
}
// ->whereExists(function($query){
//     $query->select('materials.material_id', 'materials.material_name')
//     ->from('materials')->leftJoin('inventory_material', 'materials.material_id', '=', 'inventory_material.material_id')
//     ->whereNull('inventory_material.material_id');
// })