<?php

namespace App\Http\Controllers\supp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequireController extends Controller
{
    public function index(){
        return view('supp.require.index');
    }
}
