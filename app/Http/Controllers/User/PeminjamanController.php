<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pemberitahuan;
use App\Models\Peminjaman;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function all_history()
    {
        $buku = Buku::all();

        $query = Peminjaman::where('user_id', Auth::user()->id)->get();

        $peminjamans = Peminjaman::where('user_id', Auth::user()->id)->get();

        return view('user.peminjaman.index', compact('peminjamans', 'buku', 'query'));
    }


    public function form_peminjaman_get()
    {
        $buku = Buku::all();


        return view('user.peminjaman.form.create', compact('buku'));
    }


    public function form_peminjaman_post(Request $request)
    {


        $buku_id = $request->buku_id;

        $buku = Buku::all();

        return view('user.peminjaman.form.create', compact('buku', 'buku_id'));
    }


    public function submit_peminjaman(Request $request)
    {
        $request->validate([
            'kondisi_buku_saat_dipinjam' => 'required',
            'buku_id' => 'required',
        ]);

        try {

            $unique_buku = Peminjaman::where('user_id', Auth::user()->id)->where('buku_id', $request->buku_id)->where('tanggal_pengembalian', null)->first();



            if ($unique_buku != null) {
                return redirect()->route('user.peminjaman.index')->with('status', 'danger')->with('message', 'Gagal Meminjam Buku Tidak Bisa Meminjam Buku Yang Belum Dikembalikan');
            }


            Peminjaman::create([
                'user_id'   => Auth::user()->id,
                'buku_id' => $request->buku_id,
                'tanggal_peminjaman' => $request->tanggal_peminjaman,
                'kondisi_buku_saat_dipinjam' => $request->kondisi_buku_saat_dipinjam,

            ]);

            // Jalankan If jika stock masih adai
            $buku = Buku::where('id', $request->buku_id)->first();



            if ($buku->j_buku_baik >= 1 && $buku->j_buku_rusak >= 1) {

                if ($request->kondisi_buku_saat_dipinjam == 'baik') {

                    $buku = Buku::where('id', $request->buku_id)->first();

                    $buku->update([
                        'j_buku_baik' => $buku->j_buku_baik - 1

                    ]);
                }

                if ($request->kondisi_buku_saat_dipinjam == 'rusak') {
                    $buku = Buku::where('id', $request->buku_id)->first();

                    $buku->update([
                        'j_buku_rusak' => $buku->j_buku_rusak - 1

                    ]);
                }

                // Update Pemberitahuan
                Pemberitahuan::create([
                    "isi" => Auth::user()->username . " Berhasil Meminjam Buku " . $buku->judul,
                    "status" => "peminjaman"
                ]);
                return redirect()->route('user.peminjaman.index')->with('status', 'success')->with('message', 'Berhasil Meminjam Buku');
            } else {
                return redirect()->route('user.peminjaman.index')->with('status', 'danger')->with('message', "Gagal Meminjam Buku Stock Habis");
            }
        } catch (Exception $e) {

            return redirect()->back()->with('status', 'danger')->with('message', "Gagal Meminjam Buku");
        }
    }
}
