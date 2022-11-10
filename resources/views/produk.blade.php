@extends('layouts.app')

@section('style')
    <style>
        .nav-pills .nav-link:hover {
            background-color: var(--bs-primary) !important;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card rounded-3 border-0 shadow-sm pt-4 px-3">
                    <h4 class="fw-semibold">Kategori</h4>
                    <hr>
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item mb-3">
                            <a class="nav-link" href="{{ url('/produk') }}">
                                <i class="fa-solid fa-caret-right"></i>
                                <span class="ms-1">Semua Barang</span>
                            </a>
                        </li>
                        @foreach ($kategoris as $kategori)
                            <li class="nav-item mb-3">
                                <a class="nav-link" href="{{ url('/produk?kategori=' . $kategori->slug) }}">
                                    <i class="fa-solid fa-caret-right"></i>
                                    <span class="ms-1">{{ $kategori->nama }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9 mb-3">
                <div class="row">
                    @forelse ($barangs as $barang)
                        <div class="col-md-4 mb-3">
                            <div class="card border-0 shadow-sm">
                                <img src="{{ asset('storage/barang/' . $barang->foto) }}" class="card-img-top">
                                <div class="card-body">
                                    <div
                                        class="card-text d-flex align-items-center justify-content-between gap-4 mb-2 text-black-50">
                                        <small class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-eye"></i>
                                            {{ $barang->dilihat }}x
                                        </small>
                                        <span class="text-warning">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                    </div>
                                    <h4 class="card-title fw-bold">
                                        {{ $barang->nama }}
                                        @if ($barang->diskon != 0)
                                            <span class="fs-6 badge bg-danger">
                                                <small>Disc {{ $barang->diskon }} %</small>
                                            </span>
                                        @endif
                                    </h4>
                                    <h5 class="fw-semibold">
                                        <span class="">
                                            Rp.
                                            {{ number_format($barang->harga - $barang->harga * ($barang->diskon / 100)) }}
                                        </span>
                                        @if ($barang->diskon != 0)
                                            <span class="fs-6 text-danger text-decoration-line-through">
                                                <small>Rp. {{ number_format($barang->harga) }}</small>
                                            </span>
                                        @endif
                                    </h5>
                                    <a href="{{ url('/detail/barang/' . $barang->slug, []) }}"
                                        class="btn w-100 btn-primary mt-3">
                                        Detail Barang
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-6 col-12 mb-3">
                            <img src="{{ asset('img/empty.svg') }}" class="img-fluid">
                        </div>
                        <div class="col-md-6 col-12 mb-3 align-self-center text-sm-start text-center">
                            <h1 class="display-3 fw-semibold">Oopss!</h1>
                            <h4 class="text-black-50">Barang masih kosong atau tidak ditemukan</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
