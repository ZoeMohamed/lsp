<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjams = Peminjaman::all();

        return view('admin.peminjaman.index', compact('peminjams'));
    }
}
