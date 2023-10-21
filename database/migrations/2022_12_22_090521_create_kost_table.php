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
        Schema::create('kost', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kost', 45);
            $table->string('luas_kamar', 45);
            $table->integer('harga_kamar');
            $table->text('alamat_kost');
            $table->string('keterangan', 45);
            $table->string('foto_kamar', 45);
            $table->unsignedBigInteger('id_fasilitas');
            $table->foreign('id_fasilitas')->references('id')->on('fasilitas')->onDelete('cascade');
            $table->unsignedBigInteger('kota_id');
            $table->foreign('kota_id')->references('id')->on('kota')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('unique_id', 45)->unique()->nullable(false);
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
        Schema::dropIfExists('kost');
    }
};