<?php

namespace App\Http\Controllers;



use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
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
        $token = $user->createToken('startup')->plainTextToken;

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
            return response()->json($validator->messages(), 422);
        }
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json('user not found', 401);
        }
        if (!Hash::check($request->password, $user->password)) {
            return response()->json('password is incorrect', 401);
        }
        $token = $user->createToken('startup')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token

        ], 200);
    }
    public function me()
    {
        return response()->json(auth()->user(), 200);
    }
    public function logout()
    {
        // $user = auth()->user();
        dd(auth()->user());
        // return response()->json([
        //     'user' => $user
        // ], 200);
    }
}
