<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function show_profile()
    {
        return response()->json([
            "message" => "Successfully get data",
            'data' => Auth::user()
        ]);
    }



    public function update_profile(Request $request)
    {

        $id = Auth::user()->id;

        if ($request->foto != null) {
            $imageName = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('img'), $imageName);

            $user = User::find(Auth::user()->id)->update($request->all());

            $user2 = User::find($id)->update([
                "foto" => "/img/" . $imageName
            ]);

            if ($user && $user2) {
                return response()->json([
                    "message" => "Berhasil Mengubah Profile"
                ]);
            }
        } else {
            $user = User::find(Auth::user()->id)->update($request->all());

            return response()->json([
                "message" => "Berhasil Mengubah Profile"
            ]);
        }


        return response()->json([
            "message" => "Gagal Mengubah Profile"
        ]);
    }
}
