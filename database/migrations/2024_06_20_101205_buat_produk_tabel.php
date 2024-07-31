<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table){
            $table->increments('id_produk');
            $table->integer('id_kategori');
            $table->string('nama_produk')->unique();
            $table->string('jenis')->nullable();
            $table->double('harga_beli');
            $table->tinyInteger('diskon')->default(0);
            $table->double('harga_jual');
            $table->double('stok');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
