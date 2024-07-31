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
        Schema::table('pembelian', function (Blueprint $table) {
            $table->unsignedInteger('id_supplier')->change();
            $table->foreign('id_supplier')
            ->references('id_supplier')
            ->on('supplier')
            ->onUpdate('restrict')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembelian', function (Blueprint $table) {
            $table->integer('id_supplier')->change();
            $table->dropForeign('pembelian_id_supplier_foreign');

        });
    }
};
