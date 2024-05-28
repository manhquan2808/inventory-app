<?php

namespace App\Http\Controllers\employee_prod;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Check extends Controller
{
    public function index(){
        return view('employee_prod.check.index');
    }
}
