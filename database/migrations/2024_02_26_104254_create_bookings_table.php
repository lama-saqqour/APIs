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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('car_id');
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('total_price')->nullable();
            $table->integer('booking_status')->nullable();
            $table->integer('booking_type')->nullable();
            $table->boolean('is_return')->default(0);
            $table->boolean('is_paid')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->integer('add')->nullable();
            $table->text('add_notes')->nullable();
            $table->integer('payment_type')->nullable();
            $table->string('from_lat')->nullable();
            $table->string('from_long')->nullable();
            $table->string('to_lat')->nullable();
            $table->string('to_long')->nullable();

            $table->foreignId('card_id')->nullable();
            $table->foreign('card_id')->references('id')->on('users_cards')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
