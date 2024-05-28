<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class RoleDatatable extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $state = [];
    public $perPage = 10;
    public $search = '';
    public $sortDirection = 'ASC';
    public $sortColumn = 'role_id';
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
        'state.role_name' => ['required', 'min:3'],
        'state.nickname' => ['nullable']
    ];
    public function addRole()
    {
        $validatedData = Validator::make($this->state, [
            "role_name" => 'required|string',
            "nickname" => 'required|string|unique:roles',
        ], [
            'role_name.required' => 'Tên chức vụ không được để trống.',
            'nickname.required' => 'Viết tắt của tên chức vụ không được để trống.',
            'nickname.unique' => 'Tên viết tắt đã tồn tại.'
        ])->validate();

        // Add Role data
        Role::create($validatedData);

        // session()->flash('message', "thêm");

        $this->dispatchBrowserEvent('hide-form');
    }


    public function editMode($role_id)
    {

        $role = Role::where('role_id', $role_id)->first();

        $this->state['role_edit_id'] = $role->role_id;
        $this->state['role_name_edit'] = $role->role_name;
        $this->state['nickname_edit'] = $role->nickname;

        // $this->dispatchBrowserEvent('show-edit-form');
    }

    public function editRole()
    {
        $validatedData = Validator::make($this->state, [
            "role_name_edit" => 'required|string',
            "nickname_edit" => [
                'required',
                'string',
                Rule::unique('roles', 'nickname')->ignore($this->state['role_edit_id'], 'role_id')
            ],
        ], [
            'role_name_edit.required' => 'Tên chức vụ không được để trống.',
            'nickname_edit.required' => 'Viết tắt của tên chức vụ không được để trống.',
            'nickname_edit.unique' => 'Tên viết tắt đã tồn tại.'
        ])->validate();

        $role = Role::where('role_id', $this->state['role_edit_id'])->first();
        $role->update([
            'role_name' => $this->state['role_name_edit'],
            'nickname' => strtoupper($this->state['nickname_edit'])
        ]);
        $this->dispatchBrowserEvent('hide-modal-edit');


        return redirect()->route('admin.role')->with('success', "Sửa thành công");
    }
    public function delMode($role_id)
    {
        $role = Role::where('role_id', $role_id)->first();

        $this->state['role_del_id'] = $role->role_id;
        $this->state['role_del_name'] = $role->role_name;
    }
    public function deleteRole($role_del_id)
    {
        Role::where('role_id', $role_del_id)->delete();
        // return redirect()->back()->with('success','Xoá thành công!');
        return redirect()->route('admin.role')->with('success', "Xóa thành công");

    }

    public function render()
    {
        return view('admin.livewire.role-datatable', [
            'roles' => Role::search($this->search)
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage),


        ]);
    }
}
// $this->resetInput();


// $this->dispatchBrowserEvent('hide-edit-form');
// Trong controller
// return redirect()->route('route_name')->with('success', 'Đã thực hiện thành công!');