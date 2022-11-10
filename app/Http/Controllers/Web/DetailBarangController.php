<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailBarangController extends Controller
{
    public function index($slug)
    {
        $barang  = Barang::with('kategori')->where('slug', $slug)->first();

        $barang->increment('dilihat', 1);

        if (Auth::check()) {
            $user_id = Auth::id();
        } else {
            $user_id = null;
        }

        Visit::create([
            'kategori_id' => $barang->kategori->id,
            'barang_id'   => $barang->id,
            'user_id'     => $user_id
        ]);

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
