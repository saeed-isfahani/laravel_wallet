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
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->string('currency_key');
            $table->foreign('currency_key')->references('key')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->double('rate');
            $table->string('equal_currency_key');
            $table->foreign('equal_currency_key')->references('key')->on('currencies')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rates');
    }
};
