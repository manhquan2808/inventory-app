<?php

namespace App\Http\Controllers\supp;

use App\Http\Controllers\Controller;
use App\Models\Material_input;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AcceptedController extends Controller
{

    public function index()
    {
        $acceptedMaterials = Material_input::join('materials', 'materials.material_id', '=', 'material_input.material_id')
            ->join('suppliers', 'suppliers.supplier_id', '=', 'material_input.supplier_id')
            ->where('material_input.status', '=', 'check')
            ->select('material_input.input_id', 'material_input.quantity', 'materials.material_name', 'suppliers.supplier_name')
            ->get();
        $qrcodes = [];
        foreach ($acceptedMaterials as $item) {
            $url = url('/employee/material/accept/' . $item->input_id);
            $qrcodes[] = QrCode::size(300)->generate($url);
        }
        return view('supp.accepted.index', compact('acceptedMaterials', 'qrcodes'));
    }
}
