<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaraPembelianController extends Controller
{
    public function index()
    {
        return view('cara_pembelian');
    }
}
