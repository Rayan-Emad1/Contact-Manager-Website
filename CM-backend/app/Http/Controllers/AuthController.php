<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{

    public function signUp(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|unique:users|max:255',
            'password' => 'required|string|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);

        $user->save();

        return response()->json([
            'status' => 'Signed up succesfully'
        ]);
    }


    // Sign-in method to generate JWT token
 
    public function signIn(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required|max:255',
            'password' => 'required|string|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 400);
        }

        $credentials = $request->only('phone_number', 'password');

        // Attempt to log the user in
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();

        // Generate JWT token and attach it to the user data
        $token = $user->createToken('authToken')->accessToken;
        $user->token = $token;


        return response()->json([
            'status' => 'Success',
            'name' => $user->name,
            'phone' => $user->phone_number,
            'token' => $user->token->token
        ]);
    }
}
