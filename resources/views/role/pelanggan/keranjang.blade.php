@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-3">
                {{-- KERANJANG --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="d-flex gap-3 align-items-center m-0 py-2">
                            <i class="fa-solid fa-basket-shopping"></i>
                            <span class="fw-bold">
                                Detail Keranjang
                            </span>
                        </h3>
                    </div>

                    <div class="card-body">
                        @forelse ($keranjangs as $keranjang)
                            <div class="mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <img src="{{ asset('storage/barang/' . $keranjang->barang->foto) }}" class="rounded-3"
                                        width="125">
                                    <div class="text-end">
                                        <h3 class="m-0 fw-semibold">
                                            Rp. {{ number_format($keranjang->barang->harga * $keranjang->jumlah) }}
                                        </h3>
                                        <small class="text-black-50 fw-semibold">
                                            ({{ $keranjang->jumlah }}x)
                                        </small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-3">
                                    <h5 class="fw-bold">
                                        {{ $keranjang->barang->nama }}
                                    </h5>
                                    <a href="{{ url('pelanggan/keranjang/delete/' . $keranjang->id) }}"
                                        class="badge bg-danger text-white">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </div>
                                <hr>
                            </div>
                        @empty
                            <a href="{{ url('/') }}" class="btn btn-lg btn-primary w-100">
                                Lanjutkan Belanja
                            </a>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-md-7 mb-3">
                {{-- INFORMASI PENERIMA --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="d-flex gap-3 align-items-center m-0 py-2">
                            <i class="fa-solid fa-receipt"></i>
                            <span class="fw-bold">
                                Informasi Transaksi
                            </span>
                        </h3>
                    </div>

                    @if ($keranjangs->isNotEmpty())
                        <div class="card-body">
                            <form class="row g-3" action="{{ url('/pelanggan/checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="col-12">
                                    <label for="alamat" class="form-label">Alamat Penerima</label>
                                    <input type="text" class="form-control" name="alamat" placeholder="1234 Main St"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">Provinsi</label>
                                    <select name="provinsi" class="form-select" required>
                                        <option value="" selected>Pilih...</option>
                                        @foreach ($provinces as $province => $value)
                                            <option value="{{ $province }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="kota" class="form-label">Kota</label>
                                    <select name="kota" class="form-select" required></select>
                                </div>
                                <div class="col-md-2">
                                    <label for="kurir" class="form-label">Kurir</label>
                                    <select name="kurir" class="form-select" required>
                                        <option value="" selected>Pilih...</option>
                                        <option value="jne">JNE</option>
                                        <option value="tiki">TIKI</option>
                                        <option value="pos">POS</option>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <label for="kurir" class="form-label">Total Keranjang</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" name="total" class="form-control text-end"
                                            value="{{ $totalKeranjang }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="kurir" class="form-label">Ongkos Kirim</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" name="ongkir" class="form-control text-end" id="ongkir"
                                            placeholder="0" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="kurir" class="form-label">Total Pembayaran</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Rp.</span>
                                        <input type="text" class="form-control text-end" name="grand_total"
                                            id="grand_total" placeholder="{{ $totalKeranjang }}" required readonly>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">
                                        Checkout Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let ongkir = $('#ongkir').val();
            let grand_total = $('#grand_total').val();


            $('select[name="provinsi"]').on('change', function() {
                let provinsiID = $(this).val();

                if (provinsiID) {
                    jQuery.ajax({
                        url: '/cekongkir/get-kota/' + provinsiID,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $('select[name="kota"]').empty();

                            $('select[name="kota"]').append(
                                '<option value="">Pilih...</option>'
                            );

                            $.each(response, function(key, value) {
                                $('select[name="kota"]').append(
                                    '<option value="' + key + '">' + value +
                                    '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="kota"]').append(
                        '<option value="">Pilih...</option>'
                    );
                }
            });

            $('select[name="kurir"]').on('change', function() {
                let idKota = $('select[name="kota"]').val();
                let kurir = $(this).val();

                jQuery.ajax({
                    url: "/cekongkir/" + idKota + "/" + kurir,
                    dataType: "JSON",
                    type: "GET",
                    success: function(response) {
                        if (response) {
                            let ongkir = response[0].costs[0].cost[0].value;
                            $('#ongkir').val(ongkir);

                            let grand_total = ongkir + {{ $totalKeranjang }}
                            $('#grand_total').val(grand_total);
                        }
                    }
                });
            });
        })
    </script>
@endsection
