<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request, User $users)
    {
        $keyword = $request->input('keyword');

        $users = $users->when($keyword, function ($query) use ($keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        })->where('level', 'pelanggan')->latest()->paginate(10);

        $request = $request->all();

        return view('role.admin.pelanggan.index', [
            'request'   => $request,
            'users'     => $users,
        ]);
    }
}
