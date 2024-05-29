<?php

namespace App\Http\Controllers\user\ads;

use Throwable;
use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Image;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\property\RentalResource;

class PropertyController extends ApiController
{
    public function create_rental(Request $request)
    {
        // dd($request);
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [

            'title' => 'required',
            'rental_period' => 'required',
            'monthly_rent' => 'required',
            'available_from' => 'required',
            'pet_friendly' => 'nullable',
            'country' => 'required',
            'city_id' => 'required',
            'province' => 'required',
            'description' => 'required',

        ]);




        // $rent_included_array = [$request->water ? 'water,' : null, $request->electricity ? 'electricity,' : null, $request->cable_tv ? 'cable-tv,' : null, $request->internet ? 'internet,' : null, $request->gas ? 'gas,' : null, $request->tenant_pay_all ? 'tenant-pay-all,' : null];
        // $rent_included = implode('', $request->included_rent);
        // $rent_included = rtrim(implode(',', $request->included_rent,), ',');
        $rent_included = implode(',', $request->included_rent);

        // $rent_included = $request->included_rent;

        if ($validator->fails()) {
            // return response()->json($validator->messages(), 422);
            return $this->errorResponse($validator->messages(), 422);
        }
        try {
            $property = Property::create([
                'title' => $request->title,
                'inserter_role' => $request->inserter_role,
                'type' => $request->type,
                'address' => $request->address,
                'type' => $request->type,
                'rental_period' => $request->rental_period,
                'place_type' => $request->place_type,
                'postal_code' => $request->postal_code,
                'monthly_rent' => $request->monthly_rent,
                'included_rent' => $rent_included,
                // 'province' => $request->province,
                'pet_friendly' => $request->pet_friendly,
                'smoking_allowed' => $request->smoking_allowed,
                'size' => $request->size,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                'available_from' => $request->available_from,
                'available_to' => $request->available_to,
                'furnish' => $request->furnish,
                'description' => $request->description,
                'street_address' => $request->street_address,
                "user_id" => $user->id,
                'city_id' => $request->city_id,
                'category_id' => '3',
            ]);
            return $this->successResponse($property, 201);
        } catch (Throwable $error) {
            // return response()->json([$error]);
            return $this->errorResponse($error, 500);
        };
        // return response()->json([
        //     'property' => $property,


        // ], 201);
    }

    public function get_city()
    {
        $cities = City::all();
        return $this->successResponse($cities, 200);
    }

    public function get_rental(int $id)
    {
        $property = Property::findOrFail($id);
        $images = $property->images->get(3);

        // return response(['data', $property], 200);
        return $this->successResponse(new RentalResource($property), 200);
    }


    public function create_amenities(Request $request,  $id)
    {
        // dd($request->has('laundry'));
        $user = User::find(Auth::id());
        $property = Property::findOrFail($id);
        $validator = Validator::make($request->all(), []);
        // $amenities_array = [
        //     $request->laundry ? 'laundry,' : null,
        //     $request->dishwasher ? 'dishwasher,' : null,
        //     $request->microwave ? 'microwave,' : null,
        //     $request->oven ? 'oven,' : null,
        //     $request->central_heating ? 'central_heating,' : null,
        //     $request->freezer ? 'freezer,' : null,
        //     $request->fridge ? 'fridge,' : null,
        //     $request->shared_library ? 'shared_library,' : null,
        //     $request->air_coditioning ? 'air_coditioning,' : null,
        //     $request->balcony ? 'balcony,' : null,
        //     $request->barbecue ? 'barbecue,' : null,
        //     $request->fenced_yard ? 'fenced_yard,' : null,
        //     $request->storage_space ? 'storage_space,' : null,
        //     $request->parking_space ? 'parking_space,' : null,
        //     $request->pool ? 'pool,' : null,
        //     $request->sauna ? 'sauna,' : null,
        //     $request->lawn ? 'lawn,' : null,
        //     $request->spa ? 'spa,' : null,
        //     $request->deck ? 'deck,' : null
        // ];
        $valid_amenities = implode(',', $request->amenities);
        // $accessibility_array = [
        //     $request->elementary_school ? 'elementary_school,' : null,
        //     $request->kindergarten ? 'kindergarten,' : null,
        //     $request->park ? 'park,' : null,
        //     $request->high_school ? 'high_school,' : null,
        //     $request->public_transportation ? 'public_transportation,' : null,
        //     $request->fitness_center ? 'fitness_center,' : null,
        //     $request->grocery_store ? 'grocery_store,' : null,
        //     $request->shopping_center ? 'shopping_center,' : null,
        //     $request->basketball ? 'basketball,' : null,
        // ];
        // $accessibility = rtrim(implode('', $accessibility_array), ',');
        $valid_accessibility = implode(',', $request->accessibility);



        if ($validator->fails()) {
            // return response()->json($validator->messages(), 422);
            return $this->errorResponse($validator->messages(), 422);
        }
        try {
            $property->update([
                'amenities' => $valid_amenities,
                'accessibility' => $valid_accessibility,
            ]);
            return $this->successResponse($property, 200);
        } catch (Throwable $error) {
            return response()->json([$error]);
        };
    }
    public function create_media(Request $request,  $id)
    {
        $property = Property::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'images.*' => 'image',
            'videos.*' => 'mimetypes:video/mp4',

        ]);
        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }

        if ($request->has('images') && $request->images !== null && $request->file('images')) {
            // $fileNameImages = [];
            foreach ($request->images as $image) {
                $fileNameImage = Carbon::now()->microsecond . '.' . $image->extension();
                $image->move(env('PROPERTIES_IMAGE_PATH'), $fileNameImage);
                // array_push($fileNameImages, $fileNameImage);
                $property->images()->create([
                    'image' => $fileNameImage,
                ]);
            }
        }
        if ($request->has('videos') && $request->videos !== null && $request->file('videos')) {
            foreach ($request->videos as $video) {
                $fileNamevideo = Carbon::now()->microsecond . '.' . $video->extension();
                $video->move(env('PROPERTIES_VIDEO_PATH'), $fileNamevideo);
                $property->videos()->create([
                    'video' => $fileNamevideo,
                ]);
            }
        }


        try {
            return $this->successResponse($property, 201);
        } catch (Throwable $error) {
            return response()->json([$error]);
        };
    }
    public function contact_details(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'email|nullable',
            'phone' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }
        try {
            $property->update([
                'inserter_email' => $request->inserter_email,
                'inserter_phone' => $request->inserter_phone,
                'contact_method' => implode(',', $request->contact_method),
                'viewing_option' => implode(',', $request->viewing_option),
            ]);

            return $this->successResponse($property, 201);
        } catch (Throwable $error) {
            return $this->errorResponse($error, 500);
        }
    }
    public function edit_rental_datails(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return $this->errorResponse($validator->messages(), 422);
        }
        try {
            $property->update([
                'title' => $request->title,
                'inserter_role' => $request->inserter_role,
                'type' => $request->type,
                'address' => $request->address,
                'type' => $request->type,
                'rental_period' => $request->rental_period,
                'place_type' => $request->place_type,
                'postal_code' => $request->postal_code,
                'monthly_rent' => $request->monthly_rent,
                'included_rent' => implode(',', $request->included_rent),
                'pet_friendly' => $request->pet_friendly,
                'smoking_allowed' => $request->smooking_allowed,
                'size' => $request->size,
                'country' => $request->country,
                'bedrooms' => $request->bedrooms,
                'bathrooms' => $request->bathrooms,
                // 'available_from' => $request->available_from,
                'available_to' => $request->available_to,
                'furnish' => $request->furnish,
                'description' => $request->description,
                'street_address' => $request->street_address,
                // 'city_id' => $request->city_id,

                'inserter_email' => $request->inserter_email,
                'inserter_phone' => $request->inserter_phone,
                'contact_method' => implode(',', $request->contact_method),
                'viewing_option' => implode(',', $request->viewing_option),
            ]);

            return $this->successResponse($property, 201);
        } catch (Throwable $error) {
            return $this->errorResponse($error, 500);
        }
    }
    public function delete_media(Request $request, $id)
    {
        Image::destroy($id);
        return $this->successResponse($id, 201);
    }
}
