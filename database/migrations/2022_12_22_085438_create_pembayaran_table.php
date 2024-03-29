<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bayar', 45)->nullable();
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar');
            $table->integer('total_bayar');
            $table->integer('id_kamar');
            $table->enum('pesanan', ['progress', 'diterima', 'ditolak'])->nullable();
            $table->enum('status_pembayaran', ['dibatalkan', 'diproses', 'success']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->string('metode_pembayaran', 45)->nullable();
            $table->integer('id_customer')->notnull();
            $table->string('unique_id_kost', 45)->nullable(false);
            $table->unsignedBigInteger('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};