<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Inventory;
use App\Models\Inventory_type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class InventoryTable extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $state = [];
    public $perPage = 10;
    public $search = '';
    public $sortDirection = 'ASC';
    public $sortColumn = 'inventory_id';
    public function doSort($column)
    {
        if ($this->sortColumn === $column) {
            $this->sortDirection = ($this->sortDirection == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->sortColumn = $column;
        $this->sortDirection = 'ASC';
    }
    public function updated(string $field)
    {
        $this->validateOnly($field);
    }

    protected $rules = [
        'state.inventory_name' => ['required', 'min:3'],
        'state.address' => ['nullable'],
        'state.type_id' => ['nullable'],
    ];
    public function addInventory()
    {
        $validatedData = Validator::make($this->state, [
            "inventory_name" => 'required|string',
            "address" => 'required|string',
            "type_id" => 'required|string'
            // thiếu type invetory
        ], [
            'inventory_name.required' => 'Tên kho không được để trống.',
            'address.required' => 'Địa chỉ không được để trống.',
            'type_id.required' => 'Viết tắt của tên chức vụ không được để trống.',
        ])->validate();

        // Add Role data
        $inventory = Inventory::join('inventory_type', 'inventory_type.type_id', '=', 'inventory.type_id')
            ->select('inventory.inventory_id', 'inventory.inventory_name', 'inventory.address', 'inventory_type.type_name');
        $inventory->create([
            'inventory_name' => $this->state['inventory_name'],
            'address' => ($this->state['address']),
            'type_id' => ($this->state['type_id'])
        ]);
        // session()->flash('message', "thêm");

        $this->dispatchBrowserEvent('hide-add-employee');
    }


    public function showEditInventory($inventory_id)
    {

        $inventory = Inventory::where('inventory_id', $inventory_id)->first();

        $this->state['inventory_id_edit'] = $inventory->inventory_id;
        $this->state['inventory_name_edit'] = $inventory->inventory_name;
        $this->state['address_edit'] = $inventory->address;

        // $this->dispatchBrowserEvent('show-edit-form');
    }

    public function editInventory()
    {
        $validatedData = Validator::make($this->state, [
            "inventory_name_edit" => 'required|string',
            "address_edit" => 'required|string',
        ], [
            'inventory_name_edit.required' => 'Tên kho không được để trống.',
            'address_edit.required' => 'Địa chỉ không được để trống.',
        ])->validate();

        $inventory = Inventory::where('inventory_id', $this->state['inventory_id_edit'])->first();
        $inventory->update([
            'inventory_name' => $this->state['inventory_name_edit'],
            'address' => ($this->state['address_edit'])
        ]);
        $this->dispatchBrowserEvent('hide-edit-employee');


        return redirect()->route('admin.inventory')->with('success', "Sửa thành công");
    }
    // public function showDelInventory($inventory_id)
    // {
    //     $inventory = Inventory::where('inventory_id', $inventory_id)->first();

    //     $this->state['inventory_id_del'] = $inventory->inventory_id;
    //     $this->state['inventory_name_del'] = $inventory->inventory_name;
    // }
    public function deleteInventory($inventory_id_del)
    {
        Inventory::where('inventory_id', $inventory_id_del)->delete();
        // return redirect()->back()->with('success','Xoá thành công!');
        return redirect()->route('admin.inventory')->with('success', "Xóa thành công");

    }


    public function render()
    {
        return view('admin.livewire.inventory-table', [
            'inventory' => Inventory::join('inventory_type', 'inventory_type.type_id', '=', 'inventory.type_id')
                ->whereNotIn('inventory.inventory_id', [5])
                ->select('inventory.inventory_id', 'inventory.inventory_name', 'inventory.address', 'inventory_type.type_id', 'inventory_type.type_name')
                ->search($this->search)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage),
            'inventory_type' => Inventory_type::all()
        ]);
    }
}
