<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $old_user = User::where("email", $request->email)->first();

        if ($old_user) {
            return response()->json([
                "success" => false,
                "token" => null,
                "message" => "User already exists"
            ]);
        } else {
            $new_user = new User();
            $new_user->name = $request->name;
            $new_user->email = $request->email;
            $new_user->password = Hash::make($request->password);
            $new_user->save();
            $token = $new_user->createToken('auth_token')->plainTextToken;

            return response()->json([
                "success" => true,
                "token" => $token,
                "message" => "User registered successfully"
            ]);
        }
    }


    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return response()->json([
                "success" => false,
                "token" => null,
                "message" => "Invalid username or password"
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            "success" => true,
            "token" => $token,
            "message" => "User loggedin successfully"
        ]);
    }
}
