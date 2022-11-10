@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="display-5 fw-bold">Daftar Pembelian</h3>
                <div class="mt-4 mb-3 d-flex align-items-center justify-content-between">
                    <h4 class="m-0 text-muted">Jumlah: {{ $pembelians->count() }}</h4>
                    <form action="{{ url('admin/pembelian') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control" value="{{ $request['keyword'] ?? '' }}"
                                placeholder="Pencarian...">
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
                            <th class="text-center" width="15%">Tanggal</th>
                            <th class="text-start" width="35%">Konsumen</th>
                            <th class="text-center" width="15%">Total Pembayaran</th>
                            <th class="text-center" width="15%">Status</th>
                            <th class="text-start" width="13%">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            function badge_color($value)
                            {
                                if ($value == 'Menunggu Pembayaran') {
                                    return 'danger text-white';
                                }
                            
                                if ($value == 'Diproses') {
                                    return 'warning text-white';
                                }
                            
                                if ($value == 'Dikirim') {
                                    return 'success text-white';
                                }
                            }
                        @endphp
                        @forelse ($pembelians as $pembelian)
                            <tr>
                                <td class="text-center">
                                    {{ ($pembelians->currentPage() - 1) * $pembelians->perPage() + $loop->iteration }}
                                </td>
                                <td class="text-center">{{ tanggal(substr($pembelian->created_at, 0, 10)) }}</td>
                                <td class="text-start">{{ $pembelian->nama }}</td>
                                <td class="text-start">
                                    Rp. <span class="float-end">{{ number_format($pembelian->grand_total) }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-{{ badge_color($pembelian->status) }} dropdown-toggle"
                                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $pembelian->status }}
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item text-danger"
                                                    href="{{ url('/admin/pembelian/' . $pembelian->id . '/menunggu-pembayaran') }}">
                                                    Menunggu Pembayaran
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-warning"
                                                    href="{{ url('/admin/pembelian/' . $pembelian->id . '/diproses') }}">
                                                    Diproses
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item text-success"
                                                    href="{{ url('/admin/pembelian/' . $pembelian->id . '/dikirim') }}">
                                                    Dikirim
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ url('admin/pembelian/' . $pembelian->id . '/detail') }}"
                                        class="btn btn-sm btn-primary">Detail</a>
                                    @if ($pembelian->bukti_bayar != null)
                                        <a href="{{ url('admin/pembelian/' . $pembelian->id . '/download') }}"
                                            class="btn btn-sm btn-warning">Bukti</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center py-2" colspan="6">
                                    Data Pembelian Tidak Ditemukan atau Masih Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-2">
                    {{ $pembelians->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
