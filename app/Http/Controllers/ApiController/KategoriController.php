<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function all()
    {
        $datas = Kategori::all();


        return response()->json(
            [
                "message" => "Success Fetch All Data",
                "datas" => $datas
            ]
        );
    }

    public function store(Request $request)
    {

        // Validating Data that stored
        $rules = [
            'kode' => 'required',
            'nama' => 'required',

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


        // Creating Data
        try {
            $penerbit  = Kategori::create($request->all());
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => $e
                ]
            );
        }


        // Response Json
        $created = Kategori::find($penerbit->id);

        return response()->json(
            [
                "message" => "Succsess Create Data",
                "data" => $created
            ]
        );
    }


    public function update(Request $request, $id)

    {

        // Validating Data that Updated
        $rules = [
            'kode' => 'required',
            'nama' => 'required',

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


        // Update Data
        $data = tap(Kategori::where('id', $id))
            ->update($request->all())
            ->first();


        return response()->json(
            [
                "message" => "Succsess Update Data",
                "data" => $data
            ]
        );
    }

    public function destroy($id)
    {

        $penerbit = Kategori::findorFail($id);

        $penerbit->delete();


        return response()->json(
            [
                "message" => "Succsess Delete Data",
            ]
        );
    }
}
