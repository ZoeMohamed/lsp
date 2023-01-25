<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function pesan_terkirim()
    {
        $pesans = Pesan::where('pengirim_id', Auth::user()->id)->get();

        $list_penerima = User::where('role', 'admin')->get();

        return view('user.pesan.terkirim.index', compact('pesans', 'list_penerima'));
    }

    public function pesan_masuk()
    {
        $pesans =  Pesan::where('penerima_id', Auth::user()->id)->get();

        return view('user.pesan.masuk.index', compact('pesans'));
    }


    public function edit_status($id)
    {

        try {
            tap(Pesan::where('id', $id))
                ->update([
                    'status' => 'Sudah Dibaca'
                ])
                ->first();
        } catch (Exception $e) {
            return redirect()->route('user.pesan_masuk')->with('status', 'danger')->with('message', 'Gagal Membaca Pesan');
        }
        return redirect()->route('user.pesan_masuk')->with('status', 'success')->with('message', 'Berhasil Membaca Pesan');
    }

    public function kirim_pesan(Request $request)
    {
        try {
            $pesan = Pesan::create([
                'penerima_id' => $request->penerima_id,
                "pengirim_id" => Auth::user()->id,
                "judul" => $request->judul,
                "isi" => $request->isi,
                'status' => 'Belum Dibaca',
                'tanggal_kirim' => $request->tanggal_kirim
            ]);

            return redirect()->route('user.pesan_terkirim')->with('status', 'success')->with('message', 'Berhasil Mengirim Pesan');
        } catch (Exception $e) {
            return redirect()->route('user.pesan_terkirim')->with('status', 'danger')->with('message', 'Gagal Mengirim Pesan');
        }
    }

    public function delete_pesan($id)
    {
        $pesan = Pesan::find($id);

        if ($pesan != null) {
            $pesan->delete();
            return redirect()->route('user.pesan_terkirim')->with('status', 'success')->with('message', 'Berhasil Menghapus Pesan');
        }

        return redirect()->back()->with('status', 'danger')->with('message', 'Gagal Menghapus Pesan');
    }
}
