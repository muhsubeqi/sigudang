<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->foreignId('item_id')->references('id')->on('items')->nullable()->constrained();
            $table->foreignId('user_id')->references('id')->on('users')->nullable()->constrained();
            $table->integer('qty');
            $table->enum('status', ['in', 'out']);
            $table->dateTime('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_transactions');
    }
};