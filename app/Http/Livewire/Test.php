<?php

namespace App\Http\Livewire;

use App\Models\Employee;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class Test extends Component
{

    public $state = [];
    protected $listeners = ['editEmployee' => 'editEmployee'];
    public function __construct($data)
    {
        $this->id = $data;
    }

    // public function updated(string $field)
    // {
    //     $this->validateOnly($field);
    // }
    // validate edit employee
    protected $rules = [
        "first_name" => ['required', 'string'],
        "last_name" => ['required', 'string'],
        "email" => ['required', 'email'],
        "number" => ['required', 'string', 'regex:/^[0-9]{10,11}$/'],
        "birth_date" => ['required', 'date', 'checkAge'],
    ];


    public function checkAge($attribute, $value, $fail)
    {
        $age = Carbon::parse($value)->age;
        if ($age < 18) {
            $fail('The ' . $attribute . ' must be at least 18 years old.');
        }
    }

    public function editEmployee($data)
    {

        $validatedData = Validator::make(
            $data,
            [
                "first_name" => 'required|string',
                "last_name" => 'required|string',
                "email" => 'required|email',
                "number" => 'required|string|regex:/^[0-9]{10,11}$/',
                "birth_date" => 'required|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),
            ],
            [
                'first_name.required' => 'Họ đệm không được để trống.',
                'last_name.required' => 'Tên không được để trống.',
                'email.required' => 'Email không được để trống.',
                'email.email' => 'Vui lòng nhập một địa chỉ email hợp lệ.',
                'number.required' => 'Số điện thoại không được  để trống.',
                'number.before_or_equal' => 'Tuổi phải lớn hơn 18.',
            ]
        )->validate();
        

        Employee::where('employee_id',$data['employee_id'])->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'number' => $data['number'],
            'birth_date' => $data['birth_date'],
        ]);
        $this->dispatchBrowserEvent('hide-employee-edit');


        // $this->dispatchBrowserEvent('hide-edit-form');
        // Trong controller
        return redirect()->route('admin.employee')->with('success', "Sửa thành công");
    }
    public function render()
    {
        return view('livewire.test');
    }
}




//  AI VSC chỉ tab 
// public $static = [
//     'name' => '',
//     'email' => ''
// ];

// protected $rules = [
//     'static.name' => ['required'],
//     'static.email' => ['required', 'email']
// ];

// public function mount() {
//     //$this->fill(['name' => 'John Doe']);
//     /*$user = auth()->user();
//     if($user) {
//         $this->fill([
//             'name' => $user->name,  
//             'email' => $user->email
//         ]); 
//     }*/    
// }

// public function render()
// {
//     return view('livewire.test');
// }

// public function submitForm(){

//     $this->validate();

//     Role::create([
//         'name'=>$this->static['name'],
//         'slug'=>str_replace(" ", "-", strtolower($this->static['name']))
//     ]);

//     session()->flash('message','Registro creado correctamente!');

//     $this->resetInput();
// }

// private function resetInput() {
//     $this->static = [
//         'name' => '',  
//         'email' => ''
//     ];
// }