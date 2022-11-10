<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Barang;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        $visit = Visit::selectRaw('count(id) as most_visit, kategori_id')
            ->groupBy('kategori_id')
            ->where('user_id', Auth::id())
            ->orderBy('most_visit', 'DESC')
            ->first();

        // dd($visit->kategori_id);

        $rekomendasis = Barang::where('kategori_id', $visit->kategori_id)->limit(8)->get();

        return view('beranda', [
            'banners'      => Banner::latest()->get(),
            'rekomendasis' => $rekomendasis,
            'populers'     => Barang::orderBy('dilihat', 'DESC')->limit(4)->get(),
            'newest'       => Barang::latest()->limit(4)->get(),
        ]);
    }
}
