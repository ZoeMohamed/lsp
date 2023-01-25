<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdministratorController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->where('id', '!=', Auth::user()->id)->get();

        return view('admin.administrator.index', compact('admins'));
    }


    public function store(Request $request)
    {
        // Creating Data
        try {
            $admin = User::create([
                'kode' => '',
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => 'admin',
                'verif' => 'verified',
                'join_date' => Carbon::now()
            ]);

            // Response Json
            $data = User::find($admin->id)->update([
                'kode' => 'A' . $admin->id
            ]);
        } catch (Exception $e) {
            return redirect()->route('admin.data_admin')->with('status', 'danger')->with('message', 'Gagal Menambah admin');
        }

        return redirect()->route('admin.data_admin')->with('status', 'success')->with('message', 'Berhasil Menambah admin');
    }


    public function update($id, Request $request)
    {
        $admin = tap(User::where('role', 'admin')->where('id', $id));


        if ($admin != null) {
            $admin->update([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => $request->password == "" ? $admin->password : bcrypt($request->password),
                'role' => 'admin',
            ])
                ->first();
            return redirect()->route('admin.data_admin')->with('status', 'success')->with('message', 'Berhasil Update admin');
        }

        return redirect()->route('admin.data_admin')->with('status', 'danger')->with('message', 'Gagal Update admin');
    }
    public function destroy($id)
    {
        $admins = User::find($id);
        if ($admins != null) {
            $admins->delete();

            return redirect()->route('admin.data_admin')->with('status', 'success')->with('message', 'Berhasil Menghapus Admin');
        }

        return redirect()->route('admin.data_admin')->with('status', 'success')->with('message', 'Gagal Menghapus Admin');
    }
}
