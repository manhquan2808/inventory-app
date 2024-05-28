<?php

namespace App\Http\Controllers\material;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(){
        return view('material-management.materials.index');
    }
}
