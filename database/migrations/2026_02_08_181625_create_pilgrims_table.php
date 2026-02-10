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
        Schema::create('pilgrims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->nullable()->constrained()->nullOnDelete();
            $table->uuid('uuid')->unique()->index();

            $table->string('name');
            $table->string('passport_number')->unique();
            $table->string('umrah_id')->unique();
            $table->string('hotel_madinah_name')->nullable();
            $table->date('hotel_madinah_check_in')->nullable();
            $table->date('hotel_madinah_check_out')->nullable();
            $table->string('hotel_makkah_name')->nullable();
            $table->date('hotel_makkah_check_in')->nullable();
            $table->date('hotel_makkah_check_out')->nullable();
            $table->string('photo_path')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilgrims');
    }
};
