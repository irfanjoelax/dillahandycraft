@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="display-5 fw-bold">Daftar Kategori</h3>

                <div class="mt-4 mb-3 d-flex justify-content-between">
                    <a href="{{ url('/admin/kategori/create') }}" class="btn btn-primary d-flex justify-content-between">
                        Tambah Data
                    </a>
                    <form action="{{ url('admin/kategori') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control"
                                value="{{ $request['keyword'] ?? '' }}" placeholder="Pencarian...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">#</th>
                            <th scope="col">Nama Kategori</th>
                            <th scope="col">Web Slug</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoris as $kategori)
                            <tr>
                                <td class="text-center">
                                    {{ ($kategoris->currentPage() - 1) * $kategoris->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $kategori->nama }}</td>
                                <td>{{ $kategori->slug }}</td>
                                <td>
                                    <a href="{{ url('admin/kategori/' . $kategori->id . '/edit') }}"
                                        class="btn btn-sm btn-warning">
                                        Ubah
                                    </a>
                                    <a class="btn btn-sm btn-danger"
                                        href="{{ url('/admin/kategori/' . $kategori->id, []) }}"
                                        onclick="event.preventDefault(); document.getElementById('delete-{{ $kategori->id }}').submit();">
                                        Delete
                                    </a>

                                    <form id="delete-{{ $kategori->id }}"
                                        action="{{ url('/admin/kategori/' . $kategori->id, []) }}" method="POST"
                                        class="d-none">
                                        @csrf @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center py-2" colspan="4">
                                    Data Kategori Tidak Ditemukan atau Masih Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-2">
                    {{ $kategoris->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
