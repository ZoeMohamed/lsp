<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PesanController extends Controller
{
    public function all()
    {

        $pesan_relation = Pesan::where('pengirim_id', Auth::user()->id)->get();



        $datas = [];

        $data = [];
        foreach ($pesan_relation as $pesan) {
            $data['penerima'] = $pesan->penerima->username;
            $data['pengirim'] = $pesan->pengirim->username;
            $data['judul'] = $pesan->judul;
            $data['isi'] = $pesan->isi;
            $data['status'] = $pesan->status;
            $data['tanggal_kirim'] = $pesan->tanggal_kirim;
            $datas[] = $data;
        }

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
            'penerima_id' => 'required',
            'judul' => 'required',
            'isi' => 'required',
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
            // Validating Sender Only Admin
            $pesan  = Pesan::create([
                'pengirim_id' => Auth::user()->id,
                'penerima_id' => $request->penerima_id,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal_kirim' => Carbon::now()
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => $e
                ]
            );
        }


        // Response Json
        $created = Pesan::find($pesan->id)->with('penerima', 'pengirim')->get();

        $data = [];

        foreach ($created as $message) {
            $data['id'] = $message->id;
            $data['penerima'] = $message->penerima->username;
            $data['pengirim'] = $message->pengirim->username;
            $data['judul'] = $message->judul;
            $data['isi'] = $message->isi;
            $data['status'] = $message->status;
            $data['tanggal_kirim'] = $message->tanggal_kirim;
        }
        return response()->json(
            [
                "message" => "Succsess Create Data",
                "data" => $data
            ]
        );
    }


    public function update(Request $request, $id)
    {



        //  Updating Data
        try {
            $pesan = tap(Pesan::where('id', $id))
                ->update([
                    'status' => $request->status
                ])
                ->first();
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => $e
                ]
            );
        }


        // Response Json
        $created = Pesan::find($pesan->id)->with('penerima', 'pengirim')->get();


        $data = [];

        foreach ($created as $message) {
            $data['id'] = $message->id;
            $data['penerima'] = $message->penerima->username;
            $data['pengirim'] = $message->pengirim->username;
            $data['judul'] = $message->judul;
            $data['isi'] = $message->isi;
            $data['status'] = $message->status;
            $data['tanggal_kirim'] = $message->tanggal_kirim;
        }
        return response()->json(
            [
                "message" => "Succsess Update Status",
                "data" => $data
            ]
        );
    }

    public function destroy($id)
    {
        $pesan = Pesan::findOrFail($id);

        $pesan->delete();

        return response()->json([
            "message" => "Succsess Delete pesan"
        ]);
    }
}
