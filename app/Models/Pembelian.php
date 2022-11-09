<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function pembelian_details()
    {
        return $this->hasMany('App\Models\PembelianDetail');
    }

    public function provinsi()
    {
        return $this->hasOne('App\Models\Provinsi', 'id', 'provinsi_id');
    }

    public function kota()
    {
        return $this->hasOne('App\Models\Kota', 'id', 'kota_id');
    }
}
