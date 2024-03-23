<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required',
                'username' => 'required|unique:user,username',
                'role' => 'required|in:admin,manajemen,anggota',
                'password' => 'required|min:8',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ]);


            $user = new User;
            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->username = $request->input('username');
            $user->role = $request->input('role');
            $user->password = bcrypt($request->input('password'));
            $user->remember_token = Str::random(10);

            $user->save();

            // $accessToken = $user->createToken('authToken')->accessToken;

            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully!',
                'data' => $user,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $input = [
            "username" => $request->username,
            "password" => $request->password,
        ];
        $user = User::where("username", $input["username"])->first();
        if (Auth::attempt($input)) {
            $token = $user->createToken("token")->plainTextToken;
            return response()->json([
                "code" => 200,
                "status" => "success",
                "message" => "Login success",
                "token" => $token
            ]);
        } else {
            return response()->json([
                "code" => 401,
                "status" => "error",
                "message" => "Login failed",
                "data" => null
            ]);
        }
    }
}
