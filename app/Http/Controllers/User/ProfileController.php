<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show_profile()
    {
        return view('user.profile.index');
    }

    public function show_password()
    {
        return view('user.profile.password');
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
                return redirect()->back()->with("status", "success")->with(
                    'message',
                    'Berhasil mengubah profile'
                );
            }
        } else {
            $user = User::find(Auth::user()->id)->update($request->all());

            return redirect()->back()->with("status", "success")->with(
                'message',
                'Berhasil mengubah profile'
            );
        }


        return redirect()->back()->with("status", "danger")->with('message', 'Gagal mengubah profile');
    }

    public function update_password(Request $request)
    {
        $password_old  = $request->password_old;

        $id = Auth::user()->id;

        $data = User::find($id);

        $password_new = $request->password;

        if (Hash::check($password_old, $data->password)) {
            $user = User::find(Auth::user()->id)->update([
                'password' => bcrypt($password_new)
            ]);



            return redirect()->back()->with("status", "success")->with('message', 'Berhasil mengubah Password');
        }

        return redirect()->back()->with("status", "danger")->with('message', 'Gagal mengubah Password');
    }
}
