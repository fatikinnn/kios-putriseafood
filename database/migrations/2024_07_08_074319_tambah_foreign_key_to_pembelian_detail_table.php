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
        Schema::table('pembelian_detail', function (Blueprint $table) {
            $table->unsignedInteger('id_pembelian')->change();
            $table->foreign('id_pembelian')
            ->references('id_pembelian')
            ->on('pembelian')
            ->onUpdate('restrict')
            ->onDelete('restrict');

            $table->unsignedInteger('id_produk')->change();
            $table->foreign('id_produk')
            ->references('id_produk')
            ->on('produk')
            ->onUpdate('restrict')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelian_detail', function (Blueprint $table) {
            $table->integer('id_pembelian')->change();
            $table->dropForeign('pembelian_detial_id_pembelian_foreign');

        });
    }
};
