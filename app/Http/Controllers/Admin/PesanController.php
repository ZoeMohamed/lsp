<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    //

    public function edit_status($id, Request $request)
    {
        //  Updating Data
        try {
            tap(Pesan::where('id', $id))
                ->update([
                    'status' => 'Sudah Dibaca'
                ])
                ->first();
        } catch (Exception $e) {
            return redirect()->route('admin.pesan_masuk')->with('status', 'danger')->with('message', 'Gagal Membaca Pesan');
        }
        return redirect()->route('admin.pesan_masuk')->with('status', 'success')->with('message', 'Berhasil Membaca Pesan');
    }

    public function pesan_masuk()


    {

        $data_pesan = Pesan::where('penerima_id', Auth::user()->id)->get();
        return view('admin.pesan.masuk.index', compact('data_pesan'));
    }

    public function pesan_terkirim()
    {

        $list_penerima  = User::where('role', 'user')->where('verif', 'verified')->get();

        $data_pesan = Pesan::where('pengirim_id', Auth::user()->id)->get();

        return view('admin.pesan.terkirim.index', compact('list_penerima', 'data_pesan'));
    }

    public function delete_pesan($id)


    {
        $cek = Pesan::find($id);


        if (!$cek) {

            return redirect()->back()->with('status', 'danger')->with('message', 'Gagal Menghapus Pesan');
        }

        $cek->delete();
        return redirect()->back()->with('status', 'success')->with('message', 'Berhasil Menghapus Pesan');
    }

    public function kirim_pesan(Request $request)
    {
        // Creating Data
        try {
            // Validating Sender Only Admin
            $pesan  = Pesan::create([
                'pengirim_id' => Auth::user()->id,
                'penerima_id' => $request->penerima_id,
                'judul' => $request->judul,
                'isi' => $request->isi,
                'tanggal_kirim' => $request->tanggal_kirim
            ]);
        } catch (Exception $e) {
            return redirect()->route('admin.pesan_terkirim')->with('status', 'danger')->with('message', 'Gagal Mengirim Pesan');
        }

        return redirect()->route('admin.pesan_terkirim')->with('status', 'success')->with('message', 'Berhasil Mengirim Pesan');
    }
}
