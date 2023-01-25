<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bukus = Buku::count();

        $kategoris = Kategori::count();

        $members = User::where('role', 'user')->count();

        $penerbits = Penerbit::count();
        return view('admin.dashboard', compact('bukus', 'kategoris', 'members', 'penerbits'));
    }
}
