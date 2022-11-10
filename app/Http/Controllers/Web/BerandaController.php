<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Barang;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        return view('beranda', [
            'banners'      => Banner::latest()->get(),
            'rekomendasis' => Barang::orderBy('dilihat', 'DESC')->limit(4)->get(),
        ]);
    }
}
