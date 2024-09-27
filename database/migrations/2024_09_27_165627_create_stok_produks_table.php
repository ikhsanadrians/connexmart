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
            $table->integer('stokawal');
            $table->integer('qtyin');
            $table->integer('qtyout');
            $table->integer('stok_akhir');
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
