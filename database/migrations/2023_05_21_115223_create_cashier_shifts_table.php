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
        Schema::create('cashier_shifts', function (Blueprint $table) {
            $table->id();
            $table->string("cashier_name");
            $table->integer("starting_cash");
            $table->boolean("starting_cash_added")->default(false);
            $table->dateTime("starting_shift");
            $table->dateTime("end_shift")->nullable();
            $table->integer("current_cash")->default(0)->nullable();
            $table->integer("refund_cash")->default(0)->nullable();
            $table->integer("sold_items")->default(0)->nullable();
            $table->enum("status", ["current", "ended"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashier_shifts');
    }
};
