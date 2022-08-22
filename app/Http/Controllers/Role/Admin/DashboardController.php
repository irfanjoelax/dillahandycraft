<?php

namespace App\Http\Controllers\Role\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('role.admin.dashboard');
    }
}
