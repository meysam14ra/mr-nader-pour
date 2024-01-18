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
        Schema::table('properties', function ($table) {

            $table->set('amenities', [
                'laundry',
                'dishwasher',
                'microwave',
                'oven',
                'central_heating',
                'freezer',
                'fridge',
                'shared_library',
                'air_coditioning',
                'balcony',
                'barbecue',
                'fenced_yard',
                'storage_space',
                'parking_space',
                'pool',
                'sauna',
                'lawn',
                'spa',
                'deck',
            ])->nullable();
            $table->set('accessibility', [
                'elementary_school',
                'kindergarten',
                'park',
                'high_school',
                'public_transportation',
                'fitness_center',
                'grocery_store',
                'shopping_center',
                'basketball'
            ])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
