@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h3 class="display-5 fw-bold">Daftar Pelanggan</h3>

                <div class="mt-4 mb-3 d-flex align-items-center justify-content-between">
                    <h4 class="m-0">Jumlah: {{ $users->count() }}</h4>
                    <form action="{{ url('admin/pelanggan') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="keyword" class="form-control" value="{{ $request['keyword'] ?? '' }}"
                                placeholder="Pencarian...">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="10%">#</th>
                            <th class="text-start" width="55%">Full Name</th>
                            <th class="text-start" width="35%">Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="text-center">
                                    {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-danger text-center py-2" colspan="4">
                                    Data Pelanggan Tidak Ditemukan atau Masih Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-2">
                    {{ $users->appends($request)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
