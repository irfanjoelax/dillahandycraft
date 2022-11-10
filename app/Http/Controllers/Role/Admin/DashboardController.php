<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('role.admin.dashboard', [
            'total_kategori'  => Kategori::count(),
            'total_barang'    => Barang::count(),
            'total_pelanggan' => User::where('level', 'pelanggan')->count(),
            'total_pembelian' => Pembelian::count(),
        ]);
    }
}
