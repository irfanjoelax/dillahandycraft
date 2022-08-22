@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="display-5 fw-bold mb-4">Pengaturan Profile</h3>

                <form action="{{ url('/admin/pengaturan') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                                required autofocus>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                                required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" placeholder="***">
                            <small class="form-text text-danger">
                                Kosongkan jika tidak ingin mengubah password kamu
                            </small>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-sm-6 offset-2 d-flex gap-3">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <a href="{{ route('home') }}" class="btn btn-warning">Kembali ke Dashboard</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
