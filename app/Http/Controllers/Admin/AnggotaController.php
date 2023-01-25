<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = User::where('role', 'user')->get();

        return view('admin.anggota.index', compact('anggotas'));
    }

    public function store(Request $request)
    {
        // Creating Data
        try {
            $anggota = User::create([
                'kode' => '',
                'nis' => $request->nis,
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'role' => 'user',
                'join_date' => Carbon::now()
            ]);

            // Response Json
            $data = User::find($anggota->id)->update([
                'kode' => 'U' . $anggota->id
            ]);
        } catch (Exception $e) {
            return redirect()->route('admin.data_anggota')->with('status', 'danger')->with('message', 'Gagal Menambah Anggota');
        }

        return redirect()->route('admin.data_anggota')->with('status', 'success')->with('message', 'Berhasil Menambah Anggota');
    }
    public function destroy($id)
    {
        $anggota = User::where('id', $id)->first();

        if ($anggota != null) {
            $anggota->delete();
            return redirect()->route('admin.data_anggota')->with('status', 'success')->with('message', 'Berhasil Menghapus Anggota');
        }

        return redirect()->route('admin.data_anggota')->with('status', 'danger')->with('message', 'Gagal Menghapus Anggota');
    }

    public function update($id, Request $request)
    {

        $anggota = tap(User::where('role', 'user')->where('id', $id));


        if ($anggota != null) {
            $anggota->update([
                'nis' => $request->nis,
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => $request->password == "" ? $anggota->password : bcrypt($request->password),
                'kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'role' => 'user',
            ])
                ->first();
            return redirect()->route('admin.data_anggota')->with('status', 'success')->with('message', 'Berhasil Update Anggota');
        }

        return redirect()->route('admin.data_anggota')->with('status', 'danger')->with('message', 'Gagal Update Anggota');
    }


    public function update_status($id, Request $request)
    {
        $anggota = User::where('id', $id)->first();

        if ($anggota != null) {
            if ($request->verif == 'verified') {
                $anggota->update([
                    'verif' => 'unverified'
                ]);
            }

            if ($request->verif == 'unverified') {
                $anggota->update([
                    'verif' => 'verified'
                ]);
            }

            return redirect()->route('admin.data_anggota')->with('status', 'success')->with('message', 'Berhasil Merubah Status Anggota');
        }

        return redirect()->route('admin.data_anggota')->with('status', 'danger')->with('message', 'Gagal Merubah Status Anggota');
    }
}
