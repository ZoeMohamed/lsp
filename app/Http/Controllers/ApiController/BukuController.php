<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function  all()
    {
        $buku_relation = Buku::with('kategori', 'penerbit')->get();
        $datas = [];
        $data = [];
        foreach ($buku_relation as $book) {
            $data['judul'] = $book->judul;
            $data['kategori'] = $book->kategori->nama;
            $data['penerbit'] = $book->penerbit->nama;
            $data['pengarang'] = $book->pengarang;
            $data['tahun_terbit'] = $book->tahun_terbit;
            $data['isbn'] = $book->isbn;
            $data['j_buku_baik'] = $book->j_buku_baik;
            $data['j_buku_rusak'] = $book->j_buku_rusak;

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
            'judul' => 'required',
            'kategori_id' => 'required',
            'penerbit_id' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'nullable',
            'j_buku_baik' => 'required',
            'j_buku_rusak' => 'required',
            'foto' => 'nullable'
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
            // If Foto not null
            if ($request->foto != null) {
                $imageName = time() . '.' . $request->foto->extension();

                $request->foto->move(public_path('img'), $imageName);

                $buku  = Buku::create([
                    'judul' => $request->judul,
                    'kategori_id' => $request->kategori_id,
                    'penerbit_id' => $request->penerbit_id,
                    'pengarang' => $request->pengarang,
                    'tahun_terbit' => $request->tahun_terbit,
                    'isbn' => $request->isbn,
                    'j_buku_baik' => $request->j_buku_baik,
                    'j_buku_rusak' => $request->j_buku_rusak,
                    'foto' => '/img/' . $imageName
                ]);
            } else {
                $buku  = Buku::create($request->all());
            }
        } catch (Exception $e) {

            return response()->json(
                [
                    "message" => $e
                ]
            );
        }


        // Response Json
        $created = Buku::find($buku->id)->with('kategori', 'penerbit')->get();

        $data = [];


        foreach ($created as $book) {
            $data['id'] = $book->id;
            $data['judul'] = $book->judul;
            $data['kategori'] = $book->kategori->nama;
            $data['penerbit_id'] = $book->penerbit->nama;
            $data['pengarang'] = $book->pengarang;
            $data['tahun_terbit'] = $book->tahun_terbit;
            $data['isbn'] = $book->isbn;
            $data['j_buku_baik'] = $book->j_buku_baik;
            $data['j_buku_rusak'] = $book->j_buku_rusak;
            $data['foto'] = $book->foto;
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

        // Validating Data that stored
        $rules = [
            'judul' => 'required',
            'kategori_id' => 'required',
            'penerbit_id' => 'required',
            'pengarang' => 'required',
            'tahun_terbit' => 'required',
            'isbn' => 'nullable',
            'j_buku_baik' => 'required',
            'j_buku_rusak' => 'required',
            'foto' => 'nullable'
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

        $book_id = Buku::find($id);

        if ($book_id != null) {


            if ($request->foto != null) {
                $imageName = time() . '.' . $request->foto->extension();

                $request->foto->move(public_path('img'), $imageName);
                $book = tap(Buku::with('kategori', 'penerbit')->where('id', $id))
                    ->update([

                        'judul' => $request->judul,
                        'kategori_id' => $request->kategori_id,
                        'penerbit_id' => $request->penerbit_id,
                        'pengarang' => $request->pengarang,
                        'tahun_terbit' => $request->tahun_terbit,
                        'isbn' => $request->isbn,
                        'j_buku_baik' => $request->j_buku_baik,
                        'j_buku_rusak' => $request->j_buku_rusak,
                        'foto' => '/img/' . $imageName

                    ])
                    ->first();
            } else {
                $book = tap(Buku::with('kategori', 'penerbit')->where('id', $id))
                    ->update($request->all())
                    ->first();
            }

            $data = [];

            $data['id'] = $book->id;
            $data['judul'] = $book->judul;
            $data['kategori'] = $book->kategori->nama;
            $data['penerbit'] = $book->penerbit->nama;
            $data['pengarang'] = $book->pengarang;
            $data['tahun_terbit'] = $book->tahun_terbit;
            $data['isbn'] = $book->isbn;
            $data['j_buku_baik'] = $book->j_buku_baik;
            $data['j_buku_rusak'] = $book->j_buku_rusak;
            $data['foto'] = $book->foto;


            return response()->json(
                [
                    "message" => "Succsess Update Data",
                    "data" => $data
                ]
            );
        }

        return response()->json(
            [
                "message" => "Data not found",

            ]
        );
    }

    public function destroy($id)
    {

        $book = Buku::findorFail($id);

        $book->delete();


        return response()->json(
            [
                "message" => "Succsess Delete Data",
            ]
        );
    }
}
