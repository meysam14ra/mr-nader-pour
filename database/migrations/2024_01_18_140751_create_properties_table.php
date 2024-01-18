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
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title');
            $table->enum('inserter_role', ['owner', 'agent', 'proprty-manager', 'tenant'])->nullable();
            $table->enum('type', ['detached-single', 'semi-detached', 'apartment', 'row-unit', 'condo', 'cottage', 'basement'])->nullable();
            $table->enum('place_type', ['entire-place', 'private-room', 'shared-room'])->nullable();
            $table->integer('price')->nullable();
            $table->enum('rental_period', ['long-term', 'short-term'])->nullable();
            $table->text('address')->nullable();
            $table->integer('postal_code')->nullable();
            $table->integer('size')->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->enum('furnish', ['partly-furnished', 'furnished', 'unfurnished'])->nullable();
            $table->longtext('description')->nullable();
            $table->integer('monthly_rent');
            $table->timestamp('available_from');
            $table->timestamp('available_to')->nullable();
            $table->boolean('pet_friendly');
            $table->boolean('smoking_allowed')->nullable();
            $table->string('street_address');
            $table->set('included_rent', ['water', 'electricity', 'cable-tv', 'internet', 'gas', 'tenant-pay-all'])->nullable();
            $table->string('inserter_firstname')->nullable();
            $table->string('inserter_lastname')->nullable();
            $table->string('inserter_email')->nullable();
            $table->string('inserter_phone')->nullable();
            $table->enum('contact_method', ['phone', 'email', ',message', 'whatsapp'])->nullable();
            $table->enum('viewing_option', ['video-chat', 'in-person '])->nullable();
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
