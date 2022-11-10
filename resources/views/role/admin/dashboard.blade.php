@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="bg-primary p-3 rounded-4 text-white d-flex align-items-center justify-content-between">
                    <div class="m-0">
                        <h1 class="m-0 display-4 fw-semibold">{{ number_format($total_kategori) }}</h1>
                        <h6 class="m-0 fw-semibold">
                            Total Kategori
                        </h6>
                    </div>
                    <h1 class="m-0 display-4">
                        <i class="fa-solid fa-rectangle-list"></i>
                    </h1>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="bg-warning p-3 rounded-4 text-white d-flex align-items-center justify-content-between">
                    <div class="m-0">
                        <h1 class="m-0 display-4 fw-semibold">{{ number_format($total_barang) }}</h1>
                        <h6 class="m-0 fw-semibold">
                            Total Barang
                        </h6>
                    </div>
                    <h1 class="m-0 display-4">
                        <i class="fa-solid fa-box-open"></i>
                    </h1>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="bg-success p-3 rounded-4 text-white d-flex align-items-center justify-content-between">
                    <div class="m-0">
                        <h1 class="m-0 display-4 fw-semibold">{{ number_format($total_pelanggan) }}</h1>
                        <h6 class="m-0 fw-semibold">
                            Total Pelanggan
                        </h6>
                    </div>
                    <h1 class="m-0 display-4">
                        <i class="fa-solid fa-users"></i>
                    </h1>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12 mb-3">
                <div class="bg-danger p-3 rounded-4 text-white d-flex align-items-center justify-content-between">
                    <div class="m-0">
                        <h1 class="m-0 display-4 fw-semibold">{{ number_format($total_pembelian) }}</h1>
                        <h6 class="m-0 fw-semibold">
                            Total Pembelian
                        </h6>
                    </div>
                    <h1 class="m-0 display-4">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                    </h1>
                </div>
            </div>
        </div>
    </div>
@endsection
