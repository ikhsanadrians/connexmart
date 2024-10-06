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
        Schema::create('stok_produks', function (Blueprint $table) {
            $table->id();
            $table->boolean('statusenabled');
            $table->foreignId('product_id')->constrained()->onDelete('CASCADE');
            $table->text('keterangan');
            $table->integer('stokawal')->default(0);
            $table->integer('qtyin')->default(0);
            $table->integer('qtyout')->default(0);
            $table->integer('stok_akhir')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_produks');
    }
};