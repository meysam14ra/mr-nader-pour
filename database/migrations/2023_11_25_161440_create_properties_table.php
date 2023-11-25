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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['apartment', 'house', 'loft', 'room', 'duplex']);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('price')->nullable();
            $table->text('address')->nullable();
            $table->integer('postal_code')->nullable();
            $table->integer('size')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('furnish')->nullable();
            $table->longtext('description')->nullable();
            $table->string('monthly_rent')->nullable();
            $table->timestamp('rented_from')->nullable();
            $table->timestamp('rented_to')->nullable();
            $table->string('utilities')->nullable();
            $table->boolean('pet_allowed')->nullable();
            $table->boolean('smoking_allowed')->nullable();
            $table->string('energy_rating')->nullable();
            $table->enum('amenities', ['washing_machine', 'dishwasher', 'oven', 'elevator', 'wi_fi', 'central_heating', 'air_conditioning', 'pool', 'gym', 'balcony', 'parking_space', 'storage_space', 'shared_laundry', 'security'])->nullable();
            $table->enum('neighbourhood_information', ['elementary_school', 'kindergarten', 'high_school', 'public_transportation', 'grocery_store'])->nullable();
            $table->integer('inserter_type')->nullable();
            $table->string('inserter_name')->nullable();
            $table->string('inserter_email')->nullable();
            $table->string('inserter_phone')->nullable();
            $table->enum('contact_method', ['phone', 'email', ',message', 'whatsapp'])->nullable();
            $table->enum('viewing_option', ['virtual_tour', 'appointment'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
