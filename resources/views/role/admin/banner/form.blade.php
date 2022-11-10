@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="display-5 fw-bold">Form Data Banner</h3>

                <form action="{{ $url }}" method="POST" class="mt-4 mb-3" enctype="multipart/form-data">
                    @csrf @if ($isEdit)
                        @method('PUT')
                    @endif

                    <div class="row mb-4">
                        <label for="file" class="col-sm-2 col-form-label">File Banner</label>
                        <div class="col-sm-10">
                            @if ($isEdit)
                                <img src="{{ asset('storage/banner/' . $banner->file) }}"
                                    alt="{{ asset('storage/banner/' . $banner->file) }}" class="img-thumbnail mb-2"
                                    width="350">
                            @endif
                            <input type="file" class="form-control" name="file" {{ $isEdit ? '' : 'required' }}>
                            @if ($isEdit)
                                <small class="form-text text-danger">
                                    Kosongkan jika tidak ingin mengubah file banner
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6 offset-sm-2 d-flex gap-3">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{ url('admin/banner') }}" class="btn btn-warning">Kembali ke Daftar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
