<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use Exception;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('penerbit', 'kategori')->get();

        $kategoris = Kategori::all();

        $penerbits = Penerbit::all();

        return view('admin.buku.index', compact('bukus', 'kategoris', 'penerbits'));
    }

    public function store(Request $request)
    {

        try {


            if ($request->foto != null) {

                $imageName = time() . '.' . $request->foto->extension();

                // dd($imageName);

                $request->foto->move(public_path('img'), $imageName);
                $buku  = Buku::create([
                    'judul' => $request->judul,
                    'kategori_id' => $request->kategori_id,
                    'penerbit_id' => $request->penerbit_id,
                    'pengarang' => $request->pengarang,
                    'tahun_terbit' => $request->tahun_terbit,
                    'isbn' => $request->isbn ?? "",
                    'j_buku_baik' => $request->j_buku_baik,
                    'j_buku_rusak' => $request->j_buku_rusak,
                    "foto" => "/img/" . $imageName
                ]);
            } else {
                $buku  = Buku::create([
                    'judul' => $request->judul,
                    'kategori_id' => $request->kategori_id,
                    'penerbit_id' => $request->penerbit_id,
                    'pengarang' => $request->pengarang,
                    'tahun_terbit' => $request->tahun_terbit,
                    'isbn' => $request->isbn ?? "",
                    'j_buku_baik' => $request->j_buku_baik,
                    'j_buku_rusak' => $request->j_buku_rusak,
                    "foto" => ""
                ]);
            }
        } catch (Exception $e) {
            return redirect()->route('admin.data_buku')->with('status', 'danger')->with('message', 'Gagal Menambah Buku');
        }
        return redirect()->route('admin.data_buku')->with('status', 'success')->with('message', ' Berhasil Menambah Buku');
    }

    public function update($id, Request $request)
    {
        $buku = Buku::find($id);


        if ($buku  != null) {
            if ($request->foto != null) {



                $imageName = time() . '.' . $request->foto->extension();


                $request->foto->move(public_path('img'), $imageName);

                $buku->update([
                    'judul' => $request->judul,
                    'kategori_id' => $request->kategori_id,
                    'penerbit_id' => $request->penerbit_id,
                    'pengarang' => $request->pengarang,
                    'tahun_terbit' => $request->tahun_terbit,
                    'isbn' => $request->isbn ?? "",
                    'j_buku_baik' => $request->j_buku_baik,
                    'j_buku_rusak' => $request->j_buku_rusak,
                    'foto' => "/img/" . $imageName
                ]);
            } else {
                $buku->update([
                    'judul' => $request->judul,
                    'kategori_id' => $request->kategori_id,
                    'penerbit_id' => $request->penerbit_id,
                    'pengarang' => $request->pengarang,
                    'tahun_terbit' => $request->tahun_terbit,
                    'isbn' => $request->isbn ?? "",
                    'j_buku_baik' => $request->j_buku_baik,
                    'j_buku_rusak' => $request->j_buku_rusak,
                    'foto' => $request->foto ?? ""
                ]);
            }

            return redirect()->route('admin.data_buku')->with('status', 'success')->with('message', ' Berhasil Mengupdate Buku');
        }
        return redirect()->route('admin.data_buku')->with('status', 'success')->with('message', ' Gagal Mengupdate Buku');
    }

    public function destroy($id)
    {
        $buku = Buku::find($id);

        if ($buku != null) {
            $buku->delete();
            return redirect()->route('admin.data_buku')->with('status', 'success')->with('message', ' Berhasil Menghapus Buku');
        }

        return redirect()->route('admin.data_buku')->with('status', 'danger')->with('message', ' Gagal Menghapus Buku');
    }
}
