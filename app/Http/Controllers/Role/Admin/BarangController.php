<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Barang $barangs)
    {
        $keyword = $request->input('keyword');

        $barangs = $barangs->when($keyword, function ($query) use ($keyword) {
            return $query->where('nama', 'like', '%' . $keyword . '%');
        })->latest()->paginate(10);

        $request = $request->all();

        return view('role.admin.barang.index', [
            'request'   => $request,
            'barangs'     => $barangs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.admin.barang.form', [
            'url' => url('/admin/barang'),
            'isEdit' => false,
            'kategoris' => Kategori::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('foto');
        $nameFile = $file->getClientOriginalName();

        Storage::putFileAs('/barang', $file, $nameFile);

        Barang::create([
            'nama'          => $request->nama,
            'slug'          => Str::slug($request->nama, '-'),
            'kategori_id'   => $request->kategori_id,
            'foto'          => $nameFile,
            'harga'         => $request->harga,
            'dilihat'       => 0,
            'deskripsi'     => $request->deskripsi,
        ]);

        Alert::success('Sukses', 'Data Barang Berhasil Ditambahkan');

        return redirect('admin/barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('role.admin.barang.form', [
            'url' => url('/admin/barang/' . $id),
            'isEdit' => true,
            'kategoris' => Kategori::latest()->get(),
            'barang' => Barang::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = barang::find($id);
        $nameFile = $barang->foto;

        if (!empty($file = $request->file('foto'))) {
            Storage::delete('barang/' . $barang->foto);

            $nameFile = $file->getClientOriginalName();
            Storage::putFileAs('/barang', $file, $nameFile);
        };

        $barang->update([
            'nama'          => $request->nama,
            'slug'          => Str::slug($request->nama, '-'),
            'kategori_id'   => $request->kategori_id,
            'foto'          => $nameFile,
            'harga'         => $request->harga,
            'dilihat'       => 0,
            'deskripsi'     => $request->deskripsi,
        ]);

        Alert::info('Terubah', 'Data Barang Berhasil Diubah');

        return redirect('admin/barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        Storage::delete('barang/' . $barang->file);

        $barang->delete();

        Alert::error('Terhapus', 'Data Barang Berhasil Dihapus');

        return redirect('admin/barang');
    }
}
