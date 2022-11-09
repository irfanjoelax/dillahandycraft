<?php

namespace App\Http\Controllers\Role\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Kota;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $provinsi = Provinsi::where('province_id', $request->provinsi)->first();
        $kota     = Kota::where('city_id', $request->kota)->first();

        $pembelian = Pembelian::create([
            'nama'        => $request->nama,
            'email'       => $request->email,
            'alamat'      => $request->alamat,
            'provinsi_id' => $provinsi->id,
            'kota_id'     => $kota->id,
            'kurir'       => $request->kurir,
            'total'       => $request->total,
            'ongkir'      => $request->ongkir,
            'grand_total' => $request->grand_total,
            'status'      => 'Proses',
        ]);

        $keranjangs = Keranjang::where('user_id', $request->user_id)->get();

        foreach ($keranjangs as $item) {
            PembelianDetail::create([
                'pembelian_id' => $pembelian->id,
                'user_id'      => $request->user_id,
                'barang_id'    => $item->barang_id,
                'jumlah'       => $item->jumlah,
                'total'        => $item->total,
            ]);
        }

        Keranjang::truncate();

        Alert::success('Berhasil', 'Silakan Konfirmasi Pembayaran');

        return redirect('pelanggan/dashboard');
    }
}
