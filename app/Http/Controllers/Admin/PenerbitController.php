<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Exception;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index()
    {
        $penerbits = Penerbit::all();
        return view('admin.penerbit.index', compact('penerbits'));
    }


    public function store(Request $request)
    {
        // Creating Data
        try {
            $penerbit  = Penerbit::create([
                'kode' => '',
                'nama' => $request->nama,
                'verif' => $request->verif
            ]);

            $data = Penerbit::find($penerbit->id)->update([
                'kode' => 'P' . $penerbit->id
            ]);
        } catch (Exception $e) {
            return redirect()->route('admin.data_penerbit')->with('status', 'danger')->with('message', 'Gagal Menambah Penerbit');
        }
        return redirect()->route('admin.data_penerbit')->with('status', 'success')->with('message', 'Berhasil Menambah Penerbit');
    }


    public function update($id, Request $request)
    {

        $penerbit = Penerbit::find($id);

        if ($penerbit != null) {
            $penerbit->update([
                'nama' => $request->nama
            ]);
            return redirect()->route('admin.data_penerbit')->with('status', 'success')->with('message', 'Berhasil Update Penerbit');
        }

        return redirect()->route('admin.data_penerbit')->with('status', 'danger')->with('message', 'Gagal Update Penerbit');
    }


    public function update_status($id, Request $request)
    {
        $penerbit = Penerbit::where('id', $id)->first();

        if ($penerbit != null) {
            if ($request->verif == 'verified') {
                $penerbit->update([
                    'verif' => 'unverified'
                ]);
            }

            if ($request->verif == 'unverified') {
                $penerbit->update([
                    'verif' => 'verified'
                ]);
            }

            return redirect()->route('admin.data_penerbit')->with('status', 'success')->with('message', 'Berhasil Merubah Status penerbit');
        }

        return redirect()->route('admin.data_penerbit')->with('status', 'danger')->with('message', 'Gagal Merubah Status penerbit');
    }
    public function destroy($id)
    {
        $penerbit = Penerbit::find($id);

        if ($penerbit != null) {
            $penerbit->delete();
            return redirect()->route('admin.data_penerbit')->with('status', 'success')->with('message', 'Berhasil Menghapus Penerbit');
        }

        return redirect()->route('admin.data_penerbit')->with('status', 'danger')->with('message', 'Gagal Menghapus Penerbit');
    }
}
