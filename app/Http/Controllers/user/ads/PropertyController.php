<?php

namespace App\Http\Controllers\user\ads;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class PropertyController extends Controller
{
    public function create_rental(Request $request)
    {
        // dd($request);
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [

            'type' => 'required',


        ]);
        $rent_included_array = [$request->water ? 'water,' : null, $request->electricity ? 'electricity,' : null, $request->cable_tv ? 'cable-tv,' : null, $request->internet ? 'internet,' : null, $request->gas ? 'gas,' : null, $request->tenant_pay_all ? 'tenant-pay-all' : null];
        $rent_included = implode('', $rent_included_array);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
            $property = Property::create([
                'title' => $request->title,
                'inserter_role' => $request->role,
                'type' => $request->type,
                'address' => $request->address,
                'type' => $request->type,
                'rental_period' => $request->rental_period,
                'place_type' => $request->place_type,
                'postal_code' => $request->postal_code,
                'monthly_rent' => $request->monthly_rent,
                'included_rent' => $rent_included,
                // 'province' => $request->province,
                'pet_friendly' => $request->pet,
                'smoking_allowed' => $request->smooking,
                'size' => $request->size,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'available_from' => $request->available_from,
                'available_to' => $request->available_to,
                'furnish' => $request->furnish,
                'description' => $request->description,
                'street_address' => $request->street_address,
                "user_id" => $user->id,
                'city_id' => $request->city,
                'category_id' => 3,
            ]);
            return response()->json(['data' => $property], 200);
        } catch (Throwable $error) {
            return response()->json([$error, $rent_included]);
        };
        // return response()->json([
        //     'property' => $property,


        // ], 201);
    }
    public function get_rental(int $id)
    {
        $property = Property::findOrFail($id);
        return response(['data', $property], 200);
    }

    public function create_amenities(Request $request,  $id)
    {
        // dd($request);
        $user = User::find(Auth::id());
        $property = Property::findOrFail($id);
        $validator = Validator::make($request->all(), []);
        $amenities_array = [
            $request->laundry ? 'laundry,' : null,
            $request->dishwasher ? 'dishwasher,' : null,
            $request->microwave ? 'microwave,' : null,
            $request->oven ? 'oven,' : null,
            $request->central_heating ? 'central_heating,' : null,
            $request->freezer ? 'freezer,' : null,
            $request->fridge ? 'fridge,' : null,
            $request->shared_library ? 'shared_library,' : null,
            $request->air_coditioning ? 'air_coditioning,' : null,
            $request->balcony ? 'balcony,' : null,
            $request->barbecue ? 'barbecue,' : null,
            $request->fenced_yard ? 'fenced_yard,' : null,
            $request->storage_space ? 'storage_space,' : null,
            $request->parking_space ? 'parking_space,' : null,
            $request->pool ? 'pool,' : null,
            $request->sauna ? 'sauna,' : null,
            $request->lawn ? 'lawn,' : null,
            $request->spa ? 'spa,' : null,
            $request->deck ? 'deck,' : null
        ];
        $amenities = rtrim(implode('', $amenities_array,), ',');
        $accessibility_array = [
            $request->elementary_school ? 'elementary_school,' : null,
            $request->kindergarten ? 'kindergarten,' : null,
            $request->park ? 'park,' : null,
            $request->high_school ? 'high_school,' : null,
            $request->public_transportation ? 'public_transportation,' : null,
            $request->fitness_center ? 'fitness_center,' : null,
            $request->grocery_store ? 'grocery_store,' : null,
            $request->shopping_center ? 'shopping_center,' : null,
            $request->basketball ? 'basketball,' : null,
        ];
        $accessibility = rtrim(implode('', $accessibility_array), ',');


        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
            $property->update([
                'amenities' => $amenities,
                'accessibility' => $accessibility,
            ]);
            return response()->json(['data' => $property], 200);
        } catch (Throwable $error) {
            return response()->json([$error]);
        };
    }
}
