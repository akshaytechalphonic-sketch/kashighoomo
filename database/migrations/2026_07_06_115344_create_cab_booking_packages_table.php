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
        Schema::create('cab_booking_packages', function (Blueprint $table) {
            $table->id();
            $table->string('cab_name');
            $table->string('vehicle_type');
            $table->text('images')->nullable();
            $table->integer('seating_capacity');
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cab_booking_packages');
    }
};
