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
        Schema::create('user_checkouts', function (Blueprint $table) {
            $table->id();
            $table->text("checkout_code")->nullable();
            $table->foreignId("user_id")->constrained()->nullable();
            $table->json("product_list");
            $table->integer("total_quantity")->nullable();
            $table->integer("total_price")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_checkouts');
    }
};