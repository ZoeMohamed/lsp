<?php

namespace App\Http\Controllers\Admin;

use App\Exports\AnggotaExport;
use App\Exports\ExcelExport;
use App\Exports\PeminjamanExport;
use App\Exports\PengembalianExport;
use App\Http\Controllers\Controller;
use App\Models\Identitas;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class PdfController extends Controller
{
    public function get_peminjaman()
    {

        return view('admin.pdf.report.peminjaman');
    }

    public function get_pengembalian()
    {

        return view('admin.pdf.report.pengembalian');
    }
    public function get_user()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.pdf.report.user', compact('users'));
    }

    public function download_peminjaman(Request $request)
    {
        $query = Peminjaman::where('tanggal_peminjaman', $request->tanggal_peminjaman)->with('user', 'buku')->get();

        $identitas = Identitas::find(1)->get()[0];

        if ($request->file == 'pdf') {

            $pdf = PDF::loadView('admin.pdf.peminjaman', [
                'datas' => $query,
                'tanggal_peminjaman' => $request->tanggal_peminjaman,
                'identitas' => $identitas
            ]);

            return $pdf->stream('peminjaman.pdf');
        } else if ($request->file == 'excel') {

            return Excel::download(new PeminjamanExport($request->tanggal_peminjaman, $identitas), 'peminjaman.xlsx');
        }
    }

    public function download_pengembalian(Request $request)
    {
        $query = Peminjaman::where('tanggal_pengembalian', $request->tanggal_pengembalian)->with('user', 'buku')->get();

        $identitas = Identitas::find(1)->get()[0];


        if ($request->file == 'pdf') {
            $pdf = PDF::loadView('admin.pdf.pengembalian', [
                'datas' => $query,
                'identitas' => $identitas,
                'tanggal_pengembalian' => $request->tanggal_pengembalian

            ]);

            return $pdf->stream('pengembalian.pdf');
        } else if ($request->file == 'excel') {
            return Excel::download(new PengembalianExport($request->tanggal_pengembalian, $identitas), 'pengembalian.xlsx');
        }
    }
    public function download_user(Request $request)
    {
        $query = Peminjaman::where('user_id', $request->user_id)->with('user', 'buku')->get();


        $username = User::where('id', $request->user_id)->pluck('username')->first();

        $identitas = Identitas::find(1)->get()[0];


        if ($request->file == 'pdf') {
            $pdf = PDF::loadView('admin.pdf.user', [
                'datas' => $query,
                'identitas' => $identitas,

            ]);


            return $pdf->stream('user_name.pdf');
        } else if ($request->file == 'excel') {
            return Excel::download(new AnggotaExport($request->user_id, $identitas, $username), 'anggota.xlsx');
        }
    }
}
