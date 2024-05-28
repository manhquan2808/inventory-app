<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableRequire extends Controller
{
    public function index(){
        return view('product-management.table_require.index');
    }
}
