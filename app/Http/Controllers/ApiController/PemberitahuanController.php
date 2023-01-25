<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class PemberitahuanController extends Controller
{
    public function all()
    {
        $datas = Pemberitahuan::all();

        return response()->json([
            "message" => "Succsessfully Fetch All Data",
            "datas" => $datas
        ]);
    }
}
