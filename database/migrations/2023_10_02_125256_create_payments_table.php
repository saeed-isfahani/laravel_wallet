<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Payments\Status;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('unique_id')->nullable(true);
            $table->foreignId('user_id')->nullable(true)->references('id')->on('users');
            $table->double('amount');
            $table->enum('status', Status::values());
            $table->string('currency');
            $table->timestamp('status_update_at')->nullable(true);
            $table->foreignId('status_update_by')->nullable(true)->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
