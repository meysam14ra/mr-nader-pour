<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class getPropertiesResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'accessibility' => explode(',',$this->accessibility),
            'address' => $this->address,
            'amenities' => explode(',',$this->amenities),
            'available_from'  => $this->availabale_from,
            'available_to' => $this->availabale_to,
            'bathrooms' => $this->bedrooms,
            'bedrooms' => $this->bedrooms,
            'category_id' => $this->category_id,
            'city_id', $this->city_id,
            // 'user_id', $this->user_id,
            'contact_method' => explode(',', $this->contact_method),
            'description' => $this->description,
            'furnish' => $this->furnish,
            'id' => $this->id,
            'images' => $this->images,
            'included_rent' => explode(',', $this->included_rent),
            'inserter_email' => $this->inserter_email,
            'inserter_firstname' => $this->inserter_firstname,
            'inserter_lastname' => $this->inserter_lastname,
            'inserter_phone' => $this->inserter_phone,
            'inserter_role' => $this->inserter_role,
            'monthly_rent' => $this->monthly_rent,
            'pet_friendly' => $this->pet_friendly,
            'place_type' => $this->place_type,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'price' => $this->price,
            'rental_period' => $this->rental_period,
            'size' => $this->size,
            'smoking_allowed' => $this->smoking_allowed,
            'street_address' => $this->street_address,
            'title' => $this->title,
            'type' => $this->type,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'viewing_option' => explode(',', $this->viewing_option),

        ];
    }
}
