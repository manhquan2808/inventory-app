<?php

namespace App\Http\Controllers\admin;

use App\DataTables\EmployeeDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    public function index()
    {
        return view('admin.employees.index'); // Giả sử 'employees.index' là view chứa bảng DataTable
    }

    // public function data(EmployeeDataTable $dataTable): JsonResponse
    // {
    //     return $dataTable->ajax(); // Sử dụng toJson() để trả về JSON từ DataTable
    // }
}
