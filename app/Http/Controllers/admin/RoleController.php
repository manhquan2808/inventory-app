<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function showRole(){
        $roles = Role::all();
        // return redirect()->route('admin.role', [$roles]);
        return view('admin.role.index', [$roles]);
    }
}
