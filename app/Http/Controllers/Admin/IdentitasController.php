<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Identitas;
use Illuminate\Http\Request;

class IdentitasController extends Controller
{
    public function get_identitas()
    {
        $data = Identitas::find(1)->get();

        return view('admin.identitas.index', compact('data'));
    }






    public function update_identitas(Request $request)
    {

        if ($request->foto != null) {
            $imageName = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('img'), $imageName);

            $user = Identitas::find(1)->update($request->all());

            $user2 = Identitas::find(1)->update([
                "foto" => "/img/" . $imageName
            ]);

            if ($user && $user2) {
                return redirect()->back()->with("status", "success")->with(
                    'message',
                    'Berhasil mengubah Identitas'
                );
            }
        } else {
            $user = Identitas::find(1)->update($request->all());

            return redirect()->back()->with("status", "success")->with(
                'message',
                'Berhasil mengubah Identitas'
            );
        }


        return redirect()->back()->with("status", "danger")->with('message', 'Gagal mengubah profile');
    }
}
