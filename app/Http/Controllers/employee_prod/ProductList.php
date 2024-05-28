<?php

namespace App\Http\Controllers\employee_prod;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductList extends Controller
{
    public function index(){
        return view('employee_prod.product_list.index');
    }
}
