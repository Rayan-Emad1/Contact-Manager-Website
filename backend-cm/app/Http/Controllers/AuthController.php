<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{   
    public function unauthorized(Request $request){
        return response()->json([
            'status' => 'Error',
            'message' => 'Unauthorized',
        ], 200);
    }

    
    public function signUp(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|unique:users|max:255',
            'password' => 'required|string|min:1',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = Auth::login($user);
        $user->token = $token;

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            // 'authorisation' => [
            //     'token' => $token,
            //     'type' => 'bearer',
            // ]
        ]);
    }


    public function signIn(Request $request){

        $request->validate([
            'phone_number' => 'required|max:255',
            'password' => 'required|string|min:1',
        ]);

        $credentials = $request->only('phone_number', 'password');

        // Attempt to log the user in
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthorized',
            ], 401);
        }

        // $user = Auth::user();
        // $token = $user->createToken('authToken')->accessToken;
        // $user->token = $token;

        $token = Auth::attempt($credentials);
 
        if (!$token) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        $user->token = $token;


        return response()->json([
            'status' => 'Success',
            'user' => $user,
            
        ]);
    }


    public function logout(){
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
