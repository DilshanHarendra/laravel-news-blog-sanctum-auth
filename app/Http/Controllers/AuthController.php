<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $fields=$request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);

        $user= User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])
        ]);

        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[
            'user'=>$user,
            'token'=>$token
        ];

        return response($response,201);
    }


    public function login(Request $request)
    {
        $fields=$request->validate([
            'email'=>'required|string',
            'password'=>'required|string'
        ]);
        $user=User::where('email',$fields['email'])->first();

        if (!$user)
        {
            return response([
                'message'=>'Invalid Email'
            ],401);
        }else
        {
            if (Hash::check($fields['password'],$user->password))
                {
                    $token=$user->createToken('myapptoken')->plainTextToken;
                    $response=[
                        'user'=>$user,
                        'token'=>$token
                    ];
                    return $response($response,201);
                }
            else
            {
                return response([
                    'messages'=>'Invalid Password'
                ],401);
            }
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response([
            'message'=>'Logged out'
        ],200);
    }

    public function test(Request $request)
    {
        return response([
            'message'=>'test'
        ],200);
    }
}
