<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function register(Request $request)
    {

        // Validating data that user store
        $validator  =   Validator::make($request->all(), [
            'nis' => 'required',
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
        ]);



        if ($validator->fails()) {

            //Rules for error
            $error = $validator->errors();

            return response()->json(

                [
                    "message" => $error
                ]
            );
        } else {
            $user = User::create(
                [
                    'kode' => '',
                    'nis' => $request->nis,
                    'fullname' => $request->fullname,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'kelas' => $request->kelas,
                    'alamat' => $request->alamat,
                    'verif' => 'unverified',
                    'role' => 'user',


                ]

            );


            $data = tap(User::where('id', $user->id))
                ->update(
                    ['kode' => 'U' . $user->id]
                )
                ->first();


            return response()->json([
                'message' => "Berhasil Register",
                "data" => $data,
            ]);
        }
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Successfully logout '
        ]);
    }


    public function login(Request $request)
    {
        //Check User Credential
        $credentials = [
            'username' => $request['username'],
            'password' => $request['password'],
        ];

        if (!Auth::attempt($credentials)) {
            return response()->json(
                [
                    "message" => "Invalid Credential"
                ]

            );
        }

        if (Auth::user()->verif == 'unverified') {
            return response()->json(
                [
                    'message' => 'Unverified User'
                ]
            );
        }

        $last_login = Carbon::now();

        $user = tap(User::where('id', Auth::user()->id))
            ->update(
                ['terakhir_login' => $last_login]
            )
            ->first();

        return response()->json(
            [
                "data" => $user,
                "token" => auth()->user()->createToken('secret')->plainTextToken
            ]
        );
    }

    public function all_admin()
    {
        $datas = User::where('role', 'admin')->get();

        return response()->json(
            [
                "message" => "Succsess Fetch All Data",
                "datas" => $datas
            ]
        );
    }

    public function store_admin(Request $request)
    {

        // Validating Data that stored
        $rules = [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => $errors
                ]
            );
        }


        // Creating Data
        try {
            $admin = User::create([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => "admin",
                'join_date' => Carbon::now(),
                'verif' => 'verified',
                'kode' => 'A' . $request->id
                // 'terakhir_login' => $request->terakhir_login
            ]);
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => $e
                ]
            );
        }


        // Response Json
        $created = User::findorFail($admin->id);

        $data = [];

        $data['id'] = $created->id;
        $data['fullname'] = $created->fullname;
        $data['username'] = $created->username;
        $data['terakhir_login'] = $created->terakhir_login;

        return response()->json(
            [
                "message" => "Succsess Create Data",
                "data" => $data
            ]
        );
    }


    public function update_admin(Request $request, $id)
    {
        // Validating Data that stored
        $rules = [
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => $errors
                ]
            );
        }


        $admin = tap(User::where('role', 'admin')->where('id', $id))
            ->update([
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role' => "admin",
            ])
            ->first();

        if ($admin != null) {
            return response()->json(
                [
                    "message" => "Succsess Update Data",
                    "data" => $admin
                ]
            );
        }

        return response()->json(
            [
                "message" => "Failed Update Data",
            ]
        );
    }

    public function destroy_admin($id)
    {

        $checker =  User::where('role', 'admin')->where('id', $id)->delete();


        if ($checker == 0) {
            return response()->json([
                "message" => "Failed Deleting Data",
            ]);
        }



        return response()->json([
            "message" => "Sucsess Delete Data",
        ]);
    }
    public function all_anggota()
    {
        $datas = User::where('role', 'user')->get();

        return response()->json(
            [
                "message" => "Succsess Fetch All Data",
                "datas" => $datas
            ]
        );
    }

    public function store_anggota(Request $request)
    {

        // Validating Data that stored
        $rules = [
            'nis' => 'required',
            'fullname' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => $errors
                ]
            );
        }


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
        } catch (Exception $e) {
            return response()->json(
                [
                    "message" => $e
                ]
            );
        }

        // Response Json
        $data = tap(User::where('id', $anggota->id))
            ->update(
                ['kode' => 'U' . $anggota->id]
            )
            ->first();
        return response()->json(
            [
                "message" => "Succsess Create Data",
                "data" => $data
            ]
        );
    }



    public function update_anggota(Request $request, $id)
    {
        // Validating Data that stored
        $rules = [
            'nis' => 'required',
            'fullname' => 'required',
            'username' => 'required',
            'password' => 'required',
            'kelas' => 'required',
            'alamat' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return response()->json(
                [
                    'message' => $errors
                ]
            );
        }


        $anggota = tap(User::where('role', 'user')->where('id', $id))
            ->update([
                'nis' => $request->nis,
                'fullname' => $request->fullname,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'kelas' => $request->kelas,
                'alamat' => $request->alamat,
                'role' => 'user',
                'verif' => $request->verif
            ])
            ->first();

        if ($anggota != null) {
            return response()->json(
                [
                    "message" => "Succsess Update Data",
                    "data" => $anggota
                ]
            );
        }

        return response()->json(
            [
                "message" => "Failed Update Data",
            ]
        );
    }


    public function destroy_anggota($id)
    {
        $checker =  User::where('role', 'user')->where('id', $id)->delete();


        if ($checker == 0) {
            return response()->json([
                "message" => "Failed Deleting Data",
            ]);
        }



        return response()->json([
            "message" => "Sucsess Delete Data",
        ]);
    }
}
