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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('activity_type'); // 'purchase' atau 'delete'
            $table->unsignedBigInteger('id_pembelian')->nullable();
            $table->unsignedBigInteger('id_penjualan')->nullable();
            $table->unsignedBigInteger('id_produk');
            $table->double('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
