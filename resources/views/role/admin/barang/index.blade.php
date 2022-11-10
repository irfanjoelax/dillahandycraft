@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="display-5 fw-bold">Daftar Barang</h3>

                <div class="mt-4 mb-3 d-flex justify-content-between">
                    <a href="{{ url('/admin/barang/create') }}" class="btn btn-primary d-flex justify-content-between">
                        Tambah Data
                    </a>
                    <form action="{{ url('admin/barang') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control"
                                value="{{ $request['keyword'] ?? '' }}" placeholder="Pencarian...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" width="7%">#</th>
                            <th class="text-center" width="15%">Foto</th>
                            <th class="text-start" width="50%">Nama barang</th>
                            <th class="text-center" width="8%">Dilihat</th>
                            <th class="text-center" width="7%">Diskon</th>
                            <th class="text-center" width="13%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($barangs as $barang)
                            <tr>
                                <td class="text-center">
                                    {{ ($barangs->currentPage() - 1) * $barangs->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/barang/' . $barang->foto) }}" width="100"
                                        class="rounded-3">
                                </td>
                                <td class="">
                                    <h5 class="m-0 fw-semibold">{{ $barang->nama }}</h5>
                                    {{ 'Rp.  ' . number_format($barang->harga) }}
                                </td>
                                <td class="text-center">{{ number_format($barang->dilihat) }}</td>
                                <td class="text-center">{{ $barang->diskon }} %</td>
                                <td class="text-center">
                                    <a href="{{ url('admin/barang/' . $barang->id . '/edit') }}"
                                        class="btn btn-sm btn-warning">
                                        Ubah
                                    </a>
                                    <a class="btn btn-sm btn-danger" href="{{ url('/admin/barang/' . $barang->id, []) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-{{ $barang->id }}').submit();">
                                        Delete
                                    </a>

                                    <form id="delete-{{ $barang->id }}"
                                        action="{{ url('/admin/barang/' . $barang->id, []) }}" method="POST"
                                        class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center py-2" colspan="6">
                                    Data barang Tidak Ditemukan atau Masih Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-2">
                    {{ $barangs->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
