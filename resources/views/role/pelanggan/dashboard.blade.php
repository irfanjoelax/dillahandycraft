@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="fw-bold m-0">Dashboard Daftar Pembelian</h3>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10%">#</th>
                                    <th class="text-center" width="25%">Tanggal</th>
                                    <th class="text-center" width="30%">Total Pembayaran</th>
                                    <th class="text-center" width="20%">Status</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pembelians as $pembelian)
                                    <tr>
                                        <td class="text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="text-center">
                                            {{ tanggal(substr($pembelian->created_at, 0, 10)) }}
                                        </td>
                                        <td class="text-start">
                                            Rp. <span class="float-end">{{ number_format($pembelian->grand_total) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-secondary">{{ $pembelian->status }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('pelanggan/pembelian/' . $pembelian->id . '/detail') }}"
                                                class="btn btn-sm btn-primary">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-danger text-center py-2" colspan="6">
                                            Data Pembelian Anda Masih Kosong
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
