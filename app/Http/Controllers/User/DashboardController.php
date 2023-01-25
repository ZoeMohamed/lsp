<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pemberitahuan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $buku = Buku::all();

        $pemberitahuan = Pemberitahuan::where('status', 'aktif')->get();

        return view('user.dashboard', compact('pemberitahuan', 'buku'));
    }
}
