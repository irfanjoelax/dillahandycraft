<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.admin.banner.index', [
            'banners' => Banner::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.admin.banner.form', [
            'url'    => url('/admin/banner'),
            'isEdit' => false,
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
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();

        Storage::putFileAs('/banner', $file, $nameFile);

        banner::create([
            'file'          => $nameFile,
        ]);

        Alert::success('Sukses', 'Data Banner Berhasil Ditambahkan');

        return redirect('admin/banner');
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
        return view('role.admin.banner.form', [
            'url'    => url('/admin/banner/' . $id),
            'isEdit' => true,
            'banner' => banner::find($id),
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
        $banner = Banner::find($id);
        $nameFile = $banner->file;

        if (!empty($file = $request->file('file'))) {
            Storage::delete('banner/' . $banner->file);

            $nameFile = $file->getClientOriginalName();
            Storage::putFileAs('/banner', $file, $nameFile);
        };

        $banner->update([
            'file'          => $nameFile,
        ]);

        Alert::info('Terubah', 'Data Banner Berhasil Diubah');

        return redirect('admin/banner');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = banner::find($id);
        Storage::delete('banner/' . $banner->file);

        $banner->delete();

        Alert::error('Terhapus', 'Data Banner Berhasil Dihapus');

        return redirect('admin/banner');
    }
}
