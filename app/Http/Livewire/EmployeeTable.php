<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class EmployeeTable extends Component
{
    use WithPagination;
    public $isOpen = false;
    public $employee_id_modal;
    public $state = [];
    public $perPage = 100;
    public $search = '';
    public $sortDirection = 'ASC';
    public $sortColumn = 'employee_id';
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
    public function __construct()
    {
        $this->rules['state.birth_date'] = ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')];
    }

    /**
     * The validation rules for creating form.
     *
     * @var array
     */
    protected $rules = [
        'state.employee_id_edit' => ['required', 'min:3'],
        'state.first_name_edit' => ['required', 'min:3'],
        'state.last_name_edit' => ['required', 'min:3'],
        'state.email_edit' => ['required', 'email'],
        'state.number_edit' => ['required', 'string', 'regex:/^[0-9]{10,11}$/'],
        // 'state.birth_date_edit' => ['required', 'date', 'before_or_equal:' . now()->subYears(18)->format('Y-m-d')],
        'state.role_name_edit' => ['required', 'min:3'],
        'state.inventory_name_edit' => ['required', 'min:3'],
    ];

    public function viewEmployee($employee_id)
    {
        // $employee = Employee::findOrFail($employeeId);
        // $this->emit('fetched-employee-data', $employee);
        $employee = Employee::where('employee_id', $employee_id)
            ->join('inventory', 'inventory.inventory_id', '=', 'employees.inventory_id')
            ->join('roles', 'roles.role_id', '=', 'employees.role_id')
            ->first();
        $this->state['employee_id'] = $employee->employee_id;
        $this->state['first_name'] = $employee->first_name;
        $this->state['last_name'] = $employee->last_name;
        $this->state['email'] = $employee->email;
        $this->state['number'] = $employee->number;
        $this->state['birth_date'] = $employee->birth_date;
        $this->state['role_name'] = $employee->role_name    ;
        $this->state['inventory_name'] = $employee->inventory_name;
        $this->state['create_date'] = $employee->create_date;
        $this->state['update_date'] = $employee->update_date;

    }

    public function editEmployee($employee_id_edit)
    {
        $employee = Employee::where('employee_id', $employee_id_edit)
            ->join('inventory', 'inventory.inventory_id', '=', 'employees.inventory_id')
            ->join('roles', 'roles.role_id', '=', 'employees.role_id')
            ->first();
        $this->state['employee_id_edit'] = $employee->employee_id;
        $this->state['first_name_edit'] = $employee->first_name;
        $this->state['last_name_edit'] = $employee->last_name;
        $this->state['email_edit'] = $employee->email;
        $this->state['number_edit'] = $employee->number;
        $this->state['birth_date_edit'] = $employee->birth_date;
        $this->state['role_name_edit'] = $employee->role_name;
        $this->state['inventory_name_edit'] = $employee->inventory_name;
    }

    public function deleteEmployee($employee_id_del)
    {

        // $employee = Employee::find($employee_id_del);
            // ->join('inventory', 'inventory.inventory_id', '=', 'employees.inventory_id')
            // ->join('roles', 'roles.role_id', '=', 'employees.role_id')
            // ->first();
        // $this->employee_id_modal = $employee_id_del;

    }

    public function delEmployee($employee_id_del)
    {        
        Employee::where('employee_id',$employee_id_del)->delete();
        return redirect()->route('admin.employee')->with('success', "Xóa thành công");
    }
    public function editInputEmployee()
    {
        Employee::where('employee_id', $this->state['employee_id_edit'])
            ->join('inventory', 'inventory.inventory_id', '=', 'employees.inventory_id')
            ->join('roles', 'roles.role_id', '=', 'employees.role_id')
            ->update([
                'first_name' => $this->state['first_name_edit'],
                'last_name' => $this->state['last_name_edit'],
                'email' => $this->state['email_edit'],
                'number' => $this->state['number_edit'],
                'birth_date' => $this->state['birth_date_edit'],
                'role_name' => $this->state['role_name_edit'],
                'inventory_name' => $this->state['inventory_name_edit'],
            ]);
        $this->dispatchBrowserEvent('hide-employee-edit');


        return redirect()->route('admin.employee')->with('success', "Sửa thành công");
    }

    public function render()
    {
        return view('admin.livewire.employee-table', [
            'employees' => Employee::search($this->search)
                ->join('inventory', 'inventory.inventory_id', '=', 'employees.inventory_id')
                ->join('roles', 'roles.role_id', '=', 'employees.role_id')
                ->select(
                    [
                        'employees.employee_id',
                        'employees.first_name',
                        'employees.last_name',
                        'employees.number',
                        'employees.email',
                        'employees.birth_date',
                        'employees.create_date',
                        'employees.update_date',
                        'inventory.inventory_name',
                        'roles.role_name'
                    ]
                )
                ->orderBy($this->sortColumn, $this->sortDirection)
                ->paginate($this->perPage),
            // 'employee_id_modal' => $this->employee_id_modal

        ]);
    }
}




// 'role_edit_id' => '',
//     'role_name_edit' => '',
//     'nickname_edit' => '',
// 'employee_id' => '',
// 'first_name' => '',
// 'last_name' => '',
// 'email' => '',
// 'number' => '',
// 'birth_date' => '',
// 'role_name' => '',
// 'inventory_name' => '',
// 'create_date' => '',
// 'update_date' => '',


// Validator::make(
//     $this->state,
//     // [
//     //     "first_name_edit" => 'required|string',
//     //     "last_name_edit" => 'required|string',
//     //     "email_edit" => 'required|email',
//     //     "number_edit" => 'required|string|regex:/^[0-9]{10,11}$/',
//     //     "birth_date" => 'required|date',
//         // ],
//         // [
//         //     'first_name_edit.required' => 'Họ đệm không được để trống.',
//         //     'last_name_edit.required' => 'Tên không được để trống.',
//         //     'email_edit.required' => 'Email không được để trống.',
//         //     'email_edit.email' => 'Vui lòng nhập một địa chỉ email hợp lệ.',
//         //     'number_edit.required' => 'Số điện thoại không được  để trống.',
//         // 'number.before_or_equal' => 'Tuổi phải lớn hơn 18.',
//     // ]
//     [
//         "state.first_name_edit" => 'required|string',
//         "state.last_name_edit" => 'required|string',
//         "state.email_edit" => 'required|email',
//         "state.number_edit" => 'required|string|regex:/^[0-9]{10,11}$/',
//         "state.birth_date_edit" => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
//         "state.role_name_edit" => 'required|min:3',
//         "state.inventory_name_edit" => 'required|min:3',
//     ],
//     [
//         'state.first_name_edit.required' => 'Họ đệm không được để trống.',
//         'state.last_name_edit.required' => 'Tên không được để trống.',
//         'state.email_edit.required' => 'Email không được để trống.',
//         'state.email_edit.email' => 'Vui lòng nhập một địa chỉ email hợp lệ.',
//         'state.number_edit.required' => 'Số điện thoại không được  để trống.',
//         'state.number_edit.regex' => 'Số điện thoại phải chứa từ 10 đến 11 chữ số.',
//     ]
// )->validate();