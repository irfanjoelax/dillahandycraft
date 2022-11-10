<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request, Barang $barangs)
    {
        $keyword = $request->input('keyword');
        $kategori = $request->input('kategori');

        $barangs = $barangs->when($keyword, function ($query) use ($keyword) {
            return $query->where('nama', 'like', '%' . $keyword . '%');
        });

        $barangs = $barangs->when($kategori, function ($query) use ($kategori) {
            $itemKategori = Kategori::where('slug', $kategori)->first();
            return $query->where('kategori_id', $itemKategori->id);
        });

        $request = $request->all();

        return view('produk', [
            'request'      => $request,
            'kategoris'    => Kategori::latest()->get(),
            'barangs'      => $barangs->latest()->paginate(12),
        ]);
    }
}
