@extends('layouts.app')

@section('style')
    <style>
        .text-justify {
            text-align: justify;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col-md-5 col-12 mb-3 align-self-center">
                <div class="">
                    <h1 class="display-5 fw-bold">Cara Pembelian</h1>
                    <ol class="text-justify">
                        <li class="mb-3">Klik pada tombol 'Beli' pada barang yang ingin Anda beli/pesan</li>
                        <li class="mb-3">Barang yang Anda beli/pesan akan masuk ke dalam Keranjang Belanja. Anda dapat
                            menentukan berapa
                            jumlah yang akan dibeli, kemudian klik tombol 'Simpan'</li>
                        <li class="mb-3">Jika sudah selesai, klik tombol 'Selesai Belanja' maka akan tampil data pembeli
                            beserta barang
                            yang dibeli/dipesannya. kemudian klik tombol 'Proses Order' maka akan tampil total pembayaran
                            serta
                            nomor rekening pembayaran</li>
                        <li class="mb-3">Apabila telah melakukan pembayaran, maka barang yang dibeli/dipesan akan segera
                            dikirimkan</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-7 col-12 mb-3 align-self-center">
                <img src="{{ asset('img/purchase.svg') }}" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
