@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="display-5 fw-bold">Form Data Kategori</h3>

                <form action="{{ $url }}" method="POST" class="mt-4 mb-3">
                    @csrf @if ($isEdit)
                        @method('PUT')
                    @endif
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nama"
                                value="{{ $isEdit ? $kategori->nama : '' }}" required autofocus>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6 offset-2 d-flex gap-3">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{ url('admin/kategori') }}" class="btn btn-warning">Kembali ke Daftar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
