<?php

namespace App\Http\Controllers\Role\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KeranjangController extends Controller
{
    public function index()
    {
        $provinces = Provinsi::pluck('name', 'province_id');
        $keranjangs = Keranjang::with('barang')
            ->where('user_id', Auth::id())
            ->get();

        return view('role.pelanggan.keranjang', [
            'provinces'     => $provinces,
            'keranjangs'    => $keranjangs,
            'totalKeranjang'    => $keranjangs->sum('total'),
        ]);
    }

    public function store(Request $request, $id)
    {
        $barang = Barang::find($id);

        Keranjang::create([
            'user_id'   => Auth::id(),
            'barang_id' => $barang->id,
            'jumlah'    => $request->jumlah,
            'total'     => $request->jumlah * $barang->harga,
        ]);

        Alert::success('Sukses', 'Barang Berhasil Dimasukkan Keranjang');

        return redirect('pelanggan/keranjang');
    }

    public function delete($id)
    {
        Keranjang::find($id)->delete();

        Alert::error('Sukses', 'Barang Berhasil Dihapus Dari Keranjang');

        return redirect()->back();
    }
}
