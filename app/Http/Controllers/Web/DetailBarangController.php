<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class DetailBarangController extends Controller
{
    public function index($slug)
    {
        $barang  = Barang::with('kategori')->where('slug', $slug)->first();

        $barang->increment('dilihat', 1);

        $barangs = Barang::with('kategori')
            ->where('kategori_id', $barang->kategori_id)
            ->Where('id', '!=', $barang->id)
            ->limit(8)
            ->get();

        return view('barang_detail', [
            'barang'  => $barang,
            'barangs' => $barangs
        ]);
    }
}
