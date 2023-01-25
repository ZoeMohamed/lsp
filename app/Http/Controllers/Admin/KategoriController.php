<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Exception;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    //

    public function index()
    {
        $kategoris = Kategori::all();

        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {

        try {

            $kategori =  Kategori::create([
                'kode' => lcfirst($request->nama),
                'nama' => ucfirst($request->nama)
            ]);

            // Kategori::find($kategori->id)->update([
            //     'kode' => $splitter . $kategori->id
            // ]);
        } catch (Exception $e) {
            return redirect()->route('admin.data_kategori')->with('status', 'danger')->with('message', 'Gagal Menambah Kategori');
        }
        return redirect()->route('admin.data_kategori')->with('status', 'success')->with('message', 'Berhasil Menambah Kategori');
    }

    public function update($id, Request $request)
    {
        $kategori = Kategori::find($id);

        if ($kategori != null) {
            $kategori->update([
                'nama' => $request->nama
            ]);
            return redirect()->route('admin.data_kategori')->with('status', 'success')->with('message', 'Berhasil Update kategori');
        }

        return redirect()->route('admin.data_kategori')->with('status', 'danger')->with('message', 'Gagal Update kategori');
    }
    public function destroy($id)
    {
        $kategori = Kategori::find($id);

        if ($kategori != null) {
            $kategori->delete();
            return redirect()->route('admin.data_kategori')->with('status', 'success')->with('message', 'Berhasil Menghapus Kategori');
        }
        return redirect()->route('admin.data_kategori')->with('status', 'danger')->with('message', 'Gagal Menghapus Kategori');
    }
}
