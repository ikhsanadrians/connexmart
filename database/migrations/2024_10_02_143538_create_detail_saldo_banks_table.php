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
        Schema::create('detail_saldo_banks', function (Blueprint $table) {
            $table->id();
            $table->boolean('statusenabled');
            $table->text('keterangan');
            $table->foreignId('wallet_id');
            $table->integer('saldoawal');
            $table->integer('saldoin');
            $table->integer('saldoout');
            $table->integer('saldoakhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_saldo_banks');
    }
};
