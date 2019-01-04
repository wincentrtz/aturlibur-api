<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'status' => false,
                'message' => "Register Failed"
            ], 400);
        }
        $input = $request->all();
        $user = User::create($input);
        $user->password = Hash::make($input['password']);
        $user->save();
        
        $token = auth()->attempt(['email' => $input['email'], 'password' => $input['password']]);
        return response()->json([
            'code'   => 200,
            'status' => true,
            'message'=> "Register Success",
            'token' => $token
        ], 200);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400,
                'status' => false,
                'message' => "Login Failed. Missing email or password."
            ], 400);
        }
        $token = auth()->attempt(['email' => $request->email, 'password' => $request->password]);
        if(!($token)){
            $token = auth()->attempt(['name' => $request->email, 'password' => $request->password]);
        }
        if($token){
            return response()->json([
                'code'   => 200,
                'status' => true,
                'message'=> "Login Success",
                'token' => $token
            ], 200);
        }
        return response()->json([
            'code' => 400,
            'status' => false,
            'message' => "Login Failed. Invalid email or password",
        ], 400);
    }
    public function logout(Request $request){
        auth()->logout();
        return response()->json([
            'code'   => $this->successStatus,
            'status' => true,
            'message'=> "Logout Success",
            'data'   => []
        ], $this->successStatus);
    }

    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return json()->response([
            'status' => 'success',
            'data' => $user
        ]);
    }
}
