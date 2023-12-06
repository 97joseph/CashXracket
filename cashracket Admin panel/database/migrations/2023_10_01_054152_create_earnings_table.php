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
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default(0); // website / scratch_card
            $table->text('url')->nullable(); // Only url.
            $table->double('price')->default(0); // Scratch card price / Others price.
            $table->double('reward_point')->default(0);
            $table->integer('duration')->default(0); // In seconds
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('earnings');
    }
};