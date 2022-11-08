@extends('layouts.app')

@section('style')
    <style>
        .ck-editor__editable[role="textbox"] {
            /* editing area */
            min-height: 200px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="display-5 fw-bold">Form Data Barang</h3>

                <form action="{{ $url }}" method="POST" class="mt-4 mb-3" enctype="multipart/form-data">
                    @csrf @if ($isEdit)
                        @method('PUT')
                    @endif
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nama"
                                value="{{ $isEdit ? $barang->nama : '' }}" required autofocus>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="nama" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-5">
                            <select class="form-select" name="kategori_id" required>
                                <option value="" selected>-- Daftar Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        @if ($isEdit) {{ $kategori->id == $barang->kategori_id ? 'selected' : '' }} @endif>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-3">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp.</span>
                                <input type="number" class="form-control" placeholder="0" name="harga"
                                    value="{{ $isEdit ? $barang->harga : '' }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label for="file" class="col-sm-2 col-form-label">Foto Barang</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="foto" {{ $isEdit ? '' : 'required' }}>
                            @if ($isEdit)
                                <small class="form-text text-danger">
                                    Kosongkan jika tidak ingin mengubah foto barang
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control ckeditor" name="deskripsi">{{ $isEdit ? $barang->deskripsi : '' }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6 offset-sm-2 d-flex gap-3">
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{ url('admin/barang') }}" class="btn btn-warning">Kembali ke Daftar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/ckeditor5/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('.ckeditor'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
@endsection
