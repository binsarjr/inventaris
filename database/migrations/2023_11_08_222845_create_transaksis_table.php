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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->date('tanggal_transaksi');
            $table->unsignedBigInteger('id_jenis_transaksi');
            $table->string('penerima', 100)->nullable();
            $table->string('tujuan', 100)->nullable();
            $table->longText('keterangan')->nullable();
            $table->unsignedBigInteger('id_penanggung_jawab')->nullable();
            $table->enum('status', ['direview', 'diterima', 'ditolak'])->default('direview');
            $table->string('lampiran', 100)->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('id_jenis_transaksi')->references('id')->on('jenis_transaksi')->onDelete('cascade');
            $table->foreign('id_penanggung_jawab')->references('id')->on('penanggung_jawab')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
};
