<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function all_history()
    {
        $query = Peminjaman::where('user_id', Auth::user()->id)->where('tanggal_pengembalian', null)->get();

        return view('user.pengembalian.index', compact('query'));
    }

    public function form_pengembalian_get()
    {
        // Tampilkan List Buku yang hanya dipinjam saja
        $buku = Peminjaman::where('user_id', Auth::user()->id)->whereNotNull('tanggal_peminjaman')->whereNull('tanggal_pengembalian')->with('buku')->get();

        return view('user.pengembalian.form.create', compact('buku'));
    }

    public function form_pengembalian_post(Request $request)

    {
        $buku_id = $request->buku_id;
        $buku = Buku::all();
        return view('user.pengembalian.form.create', compact('buku_id', 'buku'));
    }

    public function submit_pengembalian(Request $request)
    {

        $request->validate([
            'kondisi_buku_saat_dikembalikan' => 'required',
            'buku_id' => 'required',
            'tanggal_pengembalian' => 'required'
        ]);

        $cek = Peminjaman::where('user_id', Auth::user()->id)
            ->where('buku_id', $request->buku_id)
            ->where('tanggal_pengembalian', null)
            ->first();

        $cek->update([
            'tanggal_pengembalian'  => $request->tanggal_pengembalian,
            'kondisi_buku_saat_dikembalikan' => $request->kondisi_buku_saat_dikembalikan
        ]);

        if ($request->kondisi_buku_saat_dikembalikan == 'baik' && $cek->kondisi_buku_saat_dipinjam == "baik" && $cek->denda == null) {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_baik' => $buku->j_buku_baik + 1

            ]);

            $cek->update([
                'denda' => 0
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'rusak' && $cek->kondisi_buku_saat_dipinjam == 'baik') {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_rusak' => $buku->j_buku_rusak + 1

            ]);

            $cek->update([
                'denda' => 20000
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'rusak' && $cek->kondisi_buku_saat_dipinjam == 'rusak') {
            $buku = Buku::where('id', $request->buku_id)->first();

            $buku->update([
                'j_buku_rusak' => $buku->j_buku_rusak + 1

            ]);

            $cek->update([
                'denda' => 0
            ]);
        }

        if ($request->kondisi_buku_saat_dikembalikan == 'hilang') {
            $cek->update([
                'denda' => 50000
            ]);
        }

        if (!$cek) {

            return redirect()->back()->with('status', 'danger')->with('message', "Gagal Mengemalikan buku");
        }
        return redirect()->route('user.pengembalian')->with('status', 'success')->with('message', 'Berhasil Mengembalikan Buku');
    }
}
