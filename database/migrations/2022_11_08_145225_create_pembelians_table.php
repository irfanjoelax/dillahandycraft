<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('nama');
            $table->string('email');
            $table->text('alamat');
            $table->foreignId('provinsi_id');
            $table->foreignId('kota_id');
            $table->string('kurir');
            $table->unsignedInteger('total');
            $table->unsignedInteger('ongkir');
            $table->unsignedInteger('grand_total');
            $table->string('bukti_bayar')->nullable()->default(null);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembelians');
    }
}
