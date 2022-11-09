<?php

namespace App\Http\Controllers\Role\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class DashboardController extends Controller
{
    public function index()
    {
        return view('role.pelanggan.dashboard', [
            'pembelians' => Pembelian::where('user_id', Auth::id())->latest()->get()
        ]);
    }

    public function detail($id)
    {
        return view('role.pelanggan.detail', [
            'data' => Pembelian::find($id)
        ]);
    }

    public function upload(Request $request, $id)
    {
        $file = $request->file('bukti_bayar');
        $nameFile = $file->getClientOriginalName();

        Storage::putFileAs('/pembelian/bukti', $file, $nameFile);

        Pembelian::find($id)->update([
            'bukti_bayar' => $nameFile,
            'status'      => 'Diproses'
        ]);

        Alert::success('Berhasil', 'Pesanan Anda Akan Segera Dikirimkan');

        return redirect('pelanggan/dashboard');
    }
}
