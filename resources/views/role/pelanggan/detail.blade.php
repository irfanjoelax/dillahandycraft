@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="mb-3">
                    <a href="{{ url('pelanggan/dashboard') }}" class="btn btn-warning">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span class="ms-1">Kembali</span>
                    </a>
                    @if ($data->bukti_bayar == null)
                        <button class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            <i class="fa-solid fa-credit-card"></i>
                            <span class="ms-1">Konfirmasi Pembayaran</span>
                        </button>
                    @endif
                    <button onclick="printArea()" class="btn btn-primary ms-2">
                        <i class="fa-solid fa-print"></i>
                        <span class="ms-1">Cetak</span>
                    </button>
                </div>
                <div class="card border-0 shadow p-3" id="print-area">
                    {{-- HEADER --}}
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="text-start">
                            <img src="{{ asset('img/logo.png') }}" class="" width="50">
                            <h3 class="mt-2 fw-bolder">
                                {{ str_replace('-', ' ', env('APP_NAME')) }}
                            </h3>
                        </div>
                        <div class="text-end">
                            <h2 class="fw-bold text-primary">Detail Transaksi</h2>
                            <p class="text-muted">
                                {{ substr($data->created_at, 0, 10) }}
                            </p>
                        </div>
                    </div>

                    {{-- INFORMATION CUSTOMER DAN KURIR --}}
                    <div class="table-responsive mt-4">
                        <table class="table table-sm table-borderless" width="100%">
                            <tr>
                                <td width="19%"><strong>Nama</strong></td>
                                <td width="1%">:</td>
                                <td width="71%" colspan="4">{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <td width="19%"><strong>Email</strong></td>
                                <td width="1%">:</td>
                                <td width="71%" colspan="4">{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <td width="19%"><strong>Alamat</strong></td>
                                <td width="1%">:</td>
                                <td width="71%" colspan="4">{{ $data->alamat }}</td>
                            </tr>
                            <tr>
                                <td width="19%"><strong>Provinsi</strong></td>
                                <td width="1%">:</td>
                                <td width="20%">{{ $data->provinsi->name }}</td>
                                <td width="19%"><strong>Kota</strong></td>
                                <td width="1%">:</td>
                                <td width="40%">{{ $data->kota->name }}</td>
                            </tr>
                            <tr>
                                <td width="19%"><strong>Kurir</strong></td>
                                <td width="1%">:</td>
                                <td width="20%">{{ strtoupper($data->kurir) }}</td>
                                <td width="19%"><strong>Status</strong></td>
                                <td width="1%">:</td>
                                <td width="40%">{{ $data->status }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- INFORMATION DETAIL PENJUALAN --}}
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered table-striped">
                            <thead class="bg-primary text-white">
                                <th width="45%" class="text-start">Nama Barang</th>
                                <th width="22%" class="text-center">Harga</th>
                                <th width="10%" class="text-center">Qty</th>
                                <th width="23%" class="text-center">Sub Total</th>
                            </thead>
                            <tbody>
                                @php
                                    function cek_diskon($diskon, $harga)
                                    {
                                        if ($diskon == 0) {
                                            return $harga;
                                        } else {
                                            return $harga - $harga * ($diskon / 100);
                                        }
                                    }
                                @endphp
                                @foreach ($data->pembelian_details as $item)
                                    <tr>
                                        <td class="text-start">{{ $item->barang->nama }}</td>
                                        <td class="text-start">
                                            Rp. <span
                                                class="float-end">{{ number_format(cek_diskon($item->barang->diskon, $item->barang->harga)) }}</span>
                                        </td>
                                        <td class="text-center">{{ $item->jumlah }}</td>
                                        <td class="text-start">
                                            Rp. <span class="float-end">{{ number_format($item->total) }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- CATATAN DAN PEMBAYARAN --}}
                    <div class="row mt-4">
                        <div class="col-4"></div>
                        <div class="col-2"></div>
                        <div class="col-6 mb-2">
                            <table class="table table-sm table-striped" width="100%">
                                <tr>
                                    <td width="29%"><strong>Total</strong></td>
                                    <td width="1%">:</td>
                                    <td width="70%">
                                        Rp. <span class="float-end">{{ number_format($data->total) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="29%"><strong>Ongkos Kirim</strong></td>
                                    <td width="1%">:</td>
                                    <td width="70%">
                                        Rp. <span class="float-end">{{ number_format($data->ongkir) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="29%"><strong>Grand Total</strong></td>
                                    <td width="1%">:</td>
                                    <td width="70%">
                                        Rp. <span class="float-end">{{ number_format($data->grand_total) }}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($data->bukti_bayar == null)
        <!-- Confirm Modal -->
        <div class="modal fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="confirmModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ url('pelanggan/pembelian/' . $data->id . '/upload', []) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="confirmModalLabel">
                                Konfirmasi Pembayaran
                            </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Bukti Pembayaran</label>
                                <input type="file" class="form-control" name="bukti_bayar">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                Upload Bukti Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script>
        function printArea() {
            const printContent = document.getElementById('print-area').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContent;

            window.print()

            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
