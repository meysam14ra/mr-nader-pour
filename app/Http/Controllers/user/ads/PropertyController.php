<?php

namespace App\Http\Controllers\user\ads;

use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function create_rental(Request $request)
    {
        // dd($request);
        $user = User::find(Auth::id());

        $validator = Validator::make($request->all(), [

            'type' => 'required',


        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $property = Property::create([
            "address" => $request->address,
            "type" => $request->type,
            "postal_code" => $request->postal_code,
            "size" => $request->size,
            "bedrooms" => $request->bedrooms,
            "bathrooms" => $request->bathrooms,
            "furnish" => $request->furnish,
            "description" => $request->description,
            "user_id" => $user->id
        ]);
        return response()->json(['data' => $property], 200);
        // return response()->json([
        //     'property' => $property,


        // ], 201);
    }
    public function get_rental(int $id)
    {
        $property = Property::findOrFail($id);
        return response(['data', $property], 200);
    }
}
