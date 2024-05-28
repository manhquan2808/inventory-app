<?php

namespace App\Http\Livewire\Material;

use App\Models\Materials;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class MaterialTable extends Component
{
    use WithPagination;
    public $isOpen = false;

    public $material = [];
    public $perPage = 100;
    public $search = '';
    public $sortDirection = 'ASC';
    public $sortColumn = 'material_id';
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
        'material.material' => 'required',
        'material.material_name' => 'required|string',
        'material.unit' => 'required|string',
        'material.price_per_unit' => 'required|numeric|min:0',
    ];


    public function addmaterial()
    {
        $validatedData = Validator::make($this->material, [
            "material_name_add" => 'required|string',
            "unit_add" => 'required|string',
            "price_per_unit_add" => 'required|numeric|min:0',

        ], [
            'material_name_add.required' => 'Tên sản phẩm không được để trống.',
            'unit_add.required' => 'Đơn vị tính không được để trống.',
            'price_per_unit_add.required' => 'Chi phí sản xuất không được để trống.',
            'price_per_unit_add.numeric' => 'Chi phí sản xuất là số nguyên.',
            'price_per_unit_add.min:0' => 'Chi phí sản xuất lớn hơn 0.',
        ])->validate();
        do {
            $material_id = rand(10000, 99999);
        } while (Materials::where('material_id', $material_id)->exists());
        $material_create = Materials::create([
            'material_id' => $material_id,
            'material_name' => $validatedData['material_name_add'],
            'unit' => $validatedData['unit_add'],
            'price_per_unit' => $validatedData['price_per_unit_add'],
        ]);
        
        // session()->flash('message', 'Thêm mới thành công!');
        $this->dispatchBrowserEvent('hide-material-add');
    }
    public function editmaterial($material_id)
    {
        $material = Materials::where('material_id', $material_id)->first();
        $this->material['material_id'] = $material->material_id;
        $this->material['material_name'] = $material->material_name;
        $this->material['unit'] = $material->unit;
        $this->material['price_per_unit'] = $material->price_per_unit;


    }
    public function editInputmaterial()
    {

        $validatedData = Validator::make($this->material, [
            "material_id" => 'required',
            "material_name" => 'required|string',
            "unit" => 'required|string',
            "price_per_unit" => 'required|numeric|min:0',

        ], [
            'material_id.required' => 'Tên chức vụ không được để trống.',
            'material_name.required' => 'Tên sản phẩm không được để trống.',
            'unit.required' => 'Đơn vị tính không được để trống.',
            'price_per_unit.required' => 'Chi phí sản xuất không được để trống.',
            'price_per_unit.numeric' => 'Chi phí sản xuất là số nguyên.',
            'price_per_unit.min:0' => 'Chi phí sản xuất lớn hơn 0.',
        ])->validate();
        Materials::where('material_id', $this->material['material_id'])
            ->update([
                'material_id' => $this->material['material_id'],
                'material_name' => $this->material['material_name'],
                'unit' => $this->material['unit'],
                'price_per_unit' => $this->material['price_per_unit'],
            ]);
        $this->dispatchBrowserEvent('hide-material-edit');


        return redirect()->route('material-management.materials')->with('success', "Sửa thành công");
    }

    public function delmaterial($material_id_del)
    {
        Materials::where('material_id', $material_id_del)->delete();
        return redirect()->route('material-management.materials')->with('success', 'Xóa thành công');
    }

    public function render()
    {
        return view('livewire.material.material-table',[
        'materials' => Materials::search($this->search)
        ->select(
            [
                'materials.*',
            ]
        )
        ->orderBy($this->sortColumn, $this->sortDirection)
        ->paginate($this->perPage),]);
    }
}
