<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
            $validateUser = Validator::make($request->all(), [
                'username' => 'required',
                'password' => 'required'
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => 'error',
                    'message' => $validateUser->errors()
                ], 400);
            }

            if(!Auth::attempt($request->only('username', 'password'))){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid login details'
                ], 401);
            }

            $user = User::where('username', $request->username)->first();
            $existingToken = $user->tokens()->where('name', 'auth_token')->first();

            if ($existingToken) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'You are already logged in'
                ], 403);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Login successful',
                'data' => [
                    'token' => $user->createToken('auth_token')->plainTextToken,
                    'admin' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'username' => $user->username,
                        'phone' => $user->phone,
                        'email' => $user->email
                    ]
                ]
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function checkToken(Request $request)
    {
        try {
            $token = $request->bearerToken(); // Retrieve the token from the Authorization header
    
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No token provided'
                ], 401);
            }
    
            return response()->json([
                'status' => 'success',
                'message' => 'Token is valid',
                'data' => [
                    'token' => $token // Return the token
                ]
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
    

    public function logout(Request $request)
    {
        try{
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Logout successful'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
