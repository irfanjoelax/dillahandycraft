@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none fw-semibold" href="{{ url('/') }}">
                                Beranda
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none fw-semibold"
                                href="{{ url('/?kategori=' . $barang->kategori->slug) }}">
                                {{ $barang->kategori->nama }}
                            </a>
                        </li>
                        <li class="breadcrumb-item active fw-semibold">
                            {{ $barang->nama }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-5 col-12 mb-3">
                <img src="{{ asset('storage/barang/' . $barang->foto) }}" class="img-fluid rounded-4">

                @guest
                    <a class="btn btn-lg btn-primary w-100 mt-4" href="{{ url('/login') }}">
                        <i class="fa-solid fa-basket-shopping"></i>
                        <span class="ms-2 fw-semibold">
                            Beli Sekarang
                        </span>
                    </a>
                @endguest

                @auth
                    <form action="{{ url('/pelanggan/keranjang/store/' . $barang->id) }}" method="post" class="mt-4">
                        @csrf
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text">Jumlah</span>
                            <input type="number" class="form-control" name="jumlah" placeholder="0" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fa-solid fa-cart-arrow-down"></i>
                                <span class="ms-1">
                                    Masukkan Keranjang
                                </span>
                            </button>
                        </div>
                    </form>
                @endauth
            </div>
            <div class="col-md-7 col-12 mb-3">
                <h6 class="text-uppercase text-black-50">{{ $barang->kategori->nama }}</h6>
                <h1 class="display-6 fw-bold">
                    {{ $barang->nama }}
                </h1>
                <h3 class="fw-bold text-warning">
                    Rp. {{ number_format($barang->harga) }}
                </h3>
                <p class="text-muted mt-3">
                    {!! $barang->deskripsi !!}
                </p>
                <p class="card-text d-flex align-items-center gap-4 mb-2 text-black-50">
                    <span class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-eye"></i>
                        {{ $barang->dilihat }}x
                    </span>
                    <span class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-comments"></i>
                        10
                    </span>
                </p>
            </div>
        </div>
    @endsection
