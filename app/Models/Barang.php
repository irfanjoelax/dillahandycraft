<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }

    public function keranjang()
    {
        return $this->belongsTo('App\Models\Keranjang');
    }
}
