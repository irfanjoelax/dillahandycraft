<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class PengaturanController extends Controller
{
    public function index()
    {
        return view('role.admin.profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $password = $user->password;

        if ($request->password != NULL) {
            $password = Hash::make($request->password);
        }

        User::find($user->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
        ]);

        Alert::success('Sukses', 'Profile User Anda Telah Diperbarui');

        return redirect()->back();
    }
}
