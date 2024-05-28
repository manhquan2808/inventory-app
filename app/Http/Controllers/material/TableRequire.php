<?php

namespace App\Http\Controllers\material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TableRequire extends Controller
{
    public function index(){
        return view('material-management.table-require.index');
    }
}
