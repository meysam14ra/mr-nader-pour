<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'c_password' => 'required|same:password',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $token = $user->createToken('myApp')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token

        ], 201);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'email' => 'required|email',
            'password' => 'required|string',


        ]);
        if ($validator->fails()) {
            // return response()->json($validator->messages(), 422);
            return  $this->errorResponse($validator->messages(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->errorResponse('user not found', 401);
        }
        if (!Hash::check($request->password, $user->password)) {
            // return response()->json('password is incorrect', 401);
            return   $this->errorResponse('password is incorrect', 401);
        }
        $token = $user->createToken('myApp')->accessToken;

        return response()->json([
            'user' => $user,
            'token' => $token

        ], 200);
    }
    public function me()
    {
        $user = User::find(Auth::id());
        return response()->json(['user' => $user], 200);
    }
    public function logout()
    {

        auth()->user()->tokens()->delete();
        return response()->json('you logged out successfully!', 200);
    }
}
