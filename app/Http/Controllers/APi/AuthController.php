<?php

namespace App\Http\Controllers\APi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Register(Request $request){
        $validateData = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string'
        ]);


        $user = User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
        ]);

        $token = $user->createToken("crudrestapi")->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    //Login
    public function Login(Request $request){
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $validateData['email'])->first();

        if(!$user || !Hash::check($validateData['password'], $user->password)){
            return response(['message' => 'Invalid Credentials!']);
        }else{
            $token = $user->createToken("crudrestapi")->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token
            ];
    
            return response($response,201);
        }
    }

    //Logout
    public function Logout()
    {
        auth()->user()->tokens()->delete();

        return response(['message' => 'You are successfully logged out']);
    }
}
