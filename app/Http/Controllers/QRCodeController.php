<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class QRCodeController extends Controller
{
    public function generateQRCode($id)
    {
        $acceptUrl = url('/material/accept/' . $id);
        $returnUrl = url('/material/return/' . $id);

        $qrcodeAccept = QrCode::size(300)->generate($acceptUrl);
        $qrcodeReturn = QrCode::size(300)->generate($returnUrl);
        
        return view('qrcode', compact('qrcodeAccept', 'qrcodeReturn'));
    }
}
