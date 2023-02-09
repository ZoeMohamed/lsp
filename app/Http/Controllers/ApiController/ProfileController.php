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
        $request_datas = $request->except('foto');



        // dd($request_datas);

        if ($request->foto != null) {


            $imageName = $request->foto->getClientOriginalName();

            $request->foto->move(public_path('img'), $imageName);



            $request_datas['foto'] = "/img/" . $imageName;




            $updated = tap(User::where('id', Auth::user()->id))
                ->update($request_datas)->first();


            return response()->json(
                [
                    'message' => "Berhasil Update Profil",
                    "data" => $updated
                ]
            );
        } else {

            $updated = tap(User::where('id', Auth::user()->id))
                ->update($request_datas)->first();


            $request_datas['foto'] = null;


            return response()->json(
                [
                    'message' => "Berhasil Update Profil",
                    "data" => $updated
                ]
            );
        }

        return response()->json([
            'message' => "Gagal Update Profil"
        ]);
    }
}



// $imageName = time() . '.' . $request->foto->extension();

// $request->foto->move(public_path('img'), $imageName);

// $user =  tap(User::where('id', Auth::user()->id))
//     ->update($request->all())
//     ->first();

// $user2 = User::find($id)->update([
//     "foto" => "/img/" . $imageName
// ]);

// if ($user && $user2) {
//     return response()->json([
//         "message" => "Berhasil Mengubah Profile",
//         "data" => $user
//     ]);
// }
// } else {
// $final = tap(User::where('id', Auth::user()->id))
//     ->update($request->all())
//     ->first();

// return response()->json([
//     "message" => "Berhasil Mengubah Profile",
//     "data" => $final
// ]);
// }


// return response()->json([
// "message" => "Gagal Mengubah Profile"
// ]);
// }