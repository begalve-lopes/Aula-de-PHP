<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $crendecias=$request->only(['email','password']);

        if(Auth::attempt($crendecias)===false){
            return response()->json('Unauthorized',401);
        }

        $user=Auth::user();

        $token=$user->createToken('token',['is_admin']);

        return response()->json($token->plainTextToken);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json([
            'message'=>'success'
        ]);
    }

    public function me(Request $request){
        $user=$request->user();
        return response()->json([
            'me'=>$user,
        ]);
    }
}
