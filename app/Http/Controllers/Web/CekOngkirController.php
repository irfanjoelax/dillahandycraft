<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Kota;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CekOngkirController extends Controller
{
    public function getKota($id)
    {
        $kota = Kota::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($kota);
    }

    public function checkOngkir($idKota, $kurir)
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 278, // ID kota/kabupaten asal
            'destination'   => $idKota, // ID kota/kabupaten tujuan
            'weight'        => 1000, // berat barang dalam gram
            'courier'       => $kurir // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($cost);
    }
}
