<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pembelian;
use App\Models\User;
use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Kategori Populer',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Visit',
            'relationship_name' => 'kategori',
            'group_by_field' => 'nama',
            'chart_type' => 'pie',
            'filter_field' => 'created_at',
            'filter_period' => 'month',
        ];

        $chart = new LaravelChart($chart_options);

        return view('role.admin.dashboard', [
            'total_kategori'  => Kategori::count(),
            'total_barang'    => Barang::count(),
            'total_pelanggan' => User::where('level', 'pelanggan')->count(),
            'total_pembelian' => Pembelian::count(),
            'chart'           => $chart,
            'barang_populer'  => Barang::orderBy('dilihat', 'DESC')->limit(15)->get()
        ]);
    }
}
