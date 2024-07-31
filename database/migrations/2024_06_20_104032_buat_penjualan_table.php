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
        Schema::create('penjualan', function (Blueprint $table){
            $table->increments('id_penjualan');
            $table->integer('id_member')->nullable();
            $table->double('total_item');
            $table->double('total_harga');
            $table->tinyInteger('diskon')->default(0);
            $table->double('bayar')->default(0);
            $table->double('diterima')->default(0);
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualan');

    }
};
