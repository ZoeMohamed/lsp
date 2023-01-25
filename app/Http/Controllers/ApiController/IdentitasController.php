<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdentitasController extends Controller
{
    public function all()
    {
        $data = Identitas::all();

        return response()->json(
            [
                "message" => "Succsess Fetch Data",
                'data' => $data
            ]
        );
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nama_app' => 'required',
            'alamat_app' => 'required',
            'email_app' => 'required',
            'nomor_hp' => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => $errors
                ]
            );
        }

        $updated = tap(Identitas::where('id', $id))->update(
            [
                'nama_app' => $request->nama_app,
                'alamat_app' => $request->alamat_app,
                'email_app' => $request->email_app,
                'nomor_hp' => $request->nomor_hp,
            ]
        )->first();

        return response()->json([
            "message" => "Succsess Updated Data",
            "data" => $updated
        ]);
    }
}
