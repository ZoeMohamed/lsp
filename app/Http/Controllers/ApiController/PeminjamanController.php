<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function all_peminjam()
    {
        $peminjam_relation = Peminjaman::with('user', 'buku')->get();

        $datas = [];

        $data = [];

        foreach ($peminjam_relation as $peminjam) {
            $data['id'] = $peminjam->id;
            $data['nama'] = $peminjam->user->username;
            $data['buku_yang_dipinjam'] = $peminjam->buku->judul;
            $data['tanggal_peminjaman'] = $peminjam->tanggal_peminjaman;
            $data['tanggal_pengembalian'] = $peminjam->tanggal_pengembalian;
            $data['kondisi_buku_saat_dipinjam'] = $peminjam->kondisi_buku_saat_dipinjam;
            $data['kondisi_buku_saat_dikembalikan'] = $peminjam->kondisi_buku_saat_dikembalikan;
            $data['denda'] = $peminjam->denda;

            $datas[] = $data;
        }



        return response()->json(
            [
                "message" => "Succsess Fetch All Data",
                "datas" => $datas
            ]
        );
    }

    // public function spec_peminjaman($buku_id)
    // {


    //     $query = Peminjaman::where('user_id', Auth::user()->id)->where('buku_id', $buku_id)->get();

    //     // dd($query);

    //     foreach ($query->unique('buku_id') as $q)

    //         return response()->json(
    //             [
    //                 "message" => "Succsess Fetch Data",
    //                 "datas" => $query
    //             ]
    //         ); {


    //         return response()->json(
    //             [
    //                 "message" => "Succsess Fetch Data",
    //                 "datas" => $query
    //             ]
    //         );
    //     }
    // }

    public function show_pengembalian()
    {
        $query = Peminjaman::where('user_id', Auth::user()->id)->where('tanggal_pengembalian', null)->get();

        $datas = [];

        $data = [];

        foreach ($query as $pengembalian) {
            $data['nama_anggota'] = $pengembalian->user->username;
            $data['judul_buku'] = $pengembalian->buku->judul;
            $data['tanggal_peminjaman'] = $pengembalian->tanggal_peminjaman;
            $data['kondisi_buku_saat_dipinjam'] = $pengembalian->kondisi_buku_saat_dipinjam;
            $data['denda'] = $pengembalian->denda;
            $datas[] = $data;
        }



        return response()->json(
            [
                "message" => "Succsess Fetch Data",
                "datas" => $datas
            ]
        );
    }

    public function store_pengembalian(Request $request)
    {
        $cek = Peminjaman::where('user_id', Auth::user()->id)
            ->where('buku_id', $request->buku_id)
            ->where('tanggal_pengembalian', null)
            ->first();

        if (!$cek) {
            return response()->json([
                'msg' => 'data not found'
            ], 404);
        }

        $cek->update([
            'tanggal_pengembalian'  => $request->tanggal_pengembalian,
            'kondisi_buku_saat_dikembalikan' => $request->kondisi_buku_saat_dikembalikan
        ]);

        if ($request->kondisi_buku_saat_dikembalikan == 'baik') {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_baik' => $buku->j_buku_baik + 1

            ]);

            $cek->update([
                'denda' => 0
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'rusak') {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_rusak' => $buku->j_buku_rusak + 1

            ]);

            $cek->update([
                'denda' => 20000
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'hilang') {
            $cek->update([
                'denda' => 50000
            ]);
        }



        // Update Pemberitahuan
        Pemberitahuan::create([
            "isi" => Auth::user()->username . " Berhasil Mengembalikan Buku " . $buku->judul,
            "status" => "aktif"
        ]);

        return response()->json([
            'msg' => 'berhasil mengembalikan buku'
        ]);
    }

    public function show_peminjaman()
    {
        $query = Peminjaman::where('user_id', Auth::user()->id)->get();

        $datas = [];

        $data = [];

        foreach ($query as $peminjam) {
            $data['nama_anggota'] = $peminjam->user->username;
            $data['judul_buku'] = $peminjam->buku->judul;
            $data['tanggal_peminjaman'] = $peminjam->tanggal_peminjaman;
            $data['kondisi_buku_saat_dipinjam'] = $peminjam->kondisi_buku_saat_dipinjam;
            $data['denda'] = $peminjam->denda;
            $datas[] = $data;
        }



        return response()->json(
            [
                "message" => "Succsess Fetch Data",
                "datas" => $datas
            ]
        );
    }

    public function store_peminjaman(Request $request)
    {
        // Validating Data that stored
        $rules = [
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required',
            'kondisi_buku_saat_dipinjam' => 'required',
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

        $buku = Buku::where('id', $request->buku_id)->first();

        // Creating Data
        try {
            $peminjaman = Peminjaman::create([
                'user_id'   => Auth::user()->id,
                'buku_id' => $request->buku_id,
                'tanggal_peminjaman' => $request->tanggal_peminjaman,
                'kondisi_buku_saat_dipinjam' => $request->kondisi_buku_saat_dipinjam,

            ]);

            // Update Pemberitahuan
            Pemberitahuan::create([
                "isi" => Auth::user()->username . " Berhasil Mengembalikan Buku " . $buku->judul,
                "status" => "aktif"
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => $e
                ]
            );
        }


        // Response Json
        $created = Peminjaman::find($peminjaman->id)->with('user', 'buku')->get();

        // Decrement Stock
        $buku = Buku::where('id', $request->buku_id)->first();

        if ($request->kondisi_buku_saat_dipinjam == 'baik') {
            $buku->update([
                'j_buku_baik' => $buku->j_buku_baik - 1
            ]);
        }

        if ($request->kondisi_buku_saat_dipinjam == 'rusak') {
            $buku->update([
                'j_buku_rusak' => $buku->j_buku_rusak - 1
            ]);
        }


        $data = [];


        foreach ($created as $peminjam) {
            $data['nama_anggota'] = $peminjam->user->username;
            $data['judul_buku'] = $peminjam->buku->judul;
            $data['tanggal_peminjaman'] = $peminjam->tanggal_peminjaman;
            $data['tanggal_pengembalian'] = $peminjam->tanggal_pengembalian;
            $data['kondisi_buku_saat_dipinjam'] = $peminjam->kondisi_buku_saat_dipinjam;
            $data['kondisi_buku_saat_dikembalikan'] = $peminjam->kondisi_buku_saat_dikembalikan;
            $data['denda'] = $peminjam->denda;
        }
        return response()->json(
            [
                "message" => "Succsess Create Data",
                "data" => $data
            ]
        );
    }


    // public function update_peminjaman(Request $request, $id)
    // {
    //     // Validating Data that stored
    //     $rules = [
    //         'buku_id' => 'required',
    //         'tanggal_peminjaman' => 'required',
    //         'kondisi_buku_saat_dipinjam' => 'required',
    //     ];

    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {
    //         $errors = $validator->errors();

    //         return response()->json(
    //             [
    //                 'message' => $errors
    //             ]
    //         );
    //     }


    //     // Creating Data
    //     try {
    //         $peminjaman = tap(Peminjaman::with('user', 'buku')->where('id', $id))
    //             ->update([
    //                 'user_id'   => Auth::user()->id,
    //                 'buku_id' => $request->buku_id,
    //                 'tanggal_peminjaman' => $request->tanggal_peminjaman,
    //                 'kondisi_buku_saat_dipinjam' => $request->kondisi_buku_saat_dipinjam,

    //             ])
    //             ->first();
    //     } catch (Exception $e) {
    //         return response()->json(
    //             [
    //                 "message" => $e
    //             ]
    //         );
    //     }


    //     // Response Json
    //     $created = Peminjaman::find($peminjaman->id)->with('user', 'buku')->get();

    //     $data = [];


    //     foreach ($created as $peminjam) {
    //         $data['nama_anggota'] = $peminjam->user->username;
    //         $data['judul_buku'] = $peminjam->buku->judul;
    //         $data['tanggal_peminjaman'] = $peminjam->tanggal_peminjaman;
    //         $data['tanggal_pengembalian'] = $peminjam->tanggal_pengembalian;
    //         $data['kondisi_buku_saat_dipinjam'] = $peminjam->kondisi_buku_saat_dipinjam;
    //         $data['kondisi_buku_saat_dikembalikan'] = $peminjam->kondisi_buku_saat_dikembalikan;
    //         $data['denda'] = $peminjam->denda;
    //     }
    //     return response()->json(
    //         [
    //             "message" => "Succsess Create Data",
    //             "data" => $data
    //         ]
    //     );
    // }
}
