<?php

namespace Database\Factories;

use DateTime;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create();
        return [
            'city_id' => $faker->numberBetween(11, 19),
            'category_id' => $faker->numberBetween(3, 8),
            'user_id' => '2',
            'title' => $faker->words(4, true),
            'inserter_role' => implode(',',$faker->randomElements(['agent', 'owner', 'property-manager', 'tenant'])),
            'type' =>  implode(',',$faker->randomElements(['Detached-single', 'Semi-detached', 'Apartment', 'Row-unit', 'Condo', 'Cottage', 'Basement', 'Parking/Garage', 'Storage', 'Office', 'Retails', 'Industrial', 'Gym', 'Land'])),
            'place_type' =>  implode(',',$faker->randomElements(['entire-place', 'private-room', 'shared-room'])),
            'price' => $faker->numberBetween(10000, 99000),
            'rental_period' => implode(',',$faker->randomElements(['long-term', 'short-term'])),
            'address' => $faker->address(),
            'postal_code' => $faker->postcode(),
            'size' => $faker->numberBetween(45, 200),
            'bedrooms' => $faker->numberBetween(1, 5),
            'bathrooms' => $faker->numberBetween(1, 5),
            'furnish' =>  implode(',',$faker->randomElements(['Partly-furnished', 'Furnished', 'Unfurnished'])),
            'description' => $faker->paragraph(),
            'monthly_rent' => $faker->numberBetween(1500, 12000),
            'available_from' => $faker->dateTimeInInterval('+1 week', '+2 months'),
            'available_to' => $faker->dateTimeInInterval('+1 week', '+8 months'),
            'pet_friendly'  =>  implode(',',$faker->randomElements([0, 1])),
            'smoking_allowed'  =>  implode(',',$faker->randomElements([0, 1])),
            'street_address' => $faker->streetAddress(),
            'inserter_firstname' => $faker->firstName(),
            'inserter_lastname' => $faker->lastName(),
            'inserter_email' => $faker->email(),
            'inserter_phone' => $faker->phoneNumberWithExtension(),
            'contact_method' => implode(',',$faker->randomElements(['show_phone', 'show_email'])),
            'viewing_option' => implode(',',$faker->randomElements(['video-chat', 'in-person'])),
            'price_mode' => implode(',',$faker->randomElements(['Negotiable', 'Swap'])),
            'energy' => implode(',',$faker->randomElements(['A', 'B', 'C', 'D', 'E', 'F', 'G'])),
            // 'construction_year' => $faker->lastName(),
            'included_rent' => implode(',',$faker->randomElements(['water', 'electricity', 'cable-tv', 'internet', 'gas', 'tenant-pay-all'], null)),
            'amenities' => implode(',',$faker->randomElements(['laundry', 'dishwasher', 'microwave', 'oven', 'central_heating', 'freezer', 'fridge', 'shared_library', 'air_coditioning', 'balcony', 'barbecue', 'fenced_yard', 'storage_space', 'parking_space', 'pool', 'sauna', 'lawn', 'spa', 'deck'], null)),
            'accessibility' => implode(',',$faker->randomElements(['elementary_school', 'kindergarten', 'park', 'high_school', 'public_transportation', 'fitness_center', 'grocery_store', 'shopping_center', 'basketball'], null)),
            'publish' => 1,
            'accept' => 1









        ];
    }
}
