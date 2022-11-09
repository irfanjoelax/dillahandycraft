<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class PembelianController extends Controller
{
    public function index(Request $request, Pembelian $pembelians)
    {
        $keyword = $request->input('keyword');

        $pembelians = $pembelians->when($keyword, function ($query) use ($keyword) {
            return $query->where('nama', 'like', '%' . $keyword . '%');
        })->latest()->paginate(15);

        $request = $request->all();

        return view('role.admin.pembelian.index', [
            'request'    => $request,
            'pembelians' => $pembelians,
        ]);
    }

    public function detail($id)
    {
        return view('role.admin.pembelian.detail', [
            'data' => Pembelian::find($id)
        ]);
    }

    public function download($id)
    {
        $pembelian = Pembelian::find($id);

        return Storage::download('pembelian/bukti/' . $pembelian->bukti_bayar);
    }

    public function update_status($id, $status)
    {
        Pembelian::find($id)->update([
            'status' => ucwords(str_replace('-', ' ', $status))
        ]);

        Alert::success('Berhasil', 'Status Pesanan Berhasil Diperbarui');

        return redirect()->back();
    }
}
