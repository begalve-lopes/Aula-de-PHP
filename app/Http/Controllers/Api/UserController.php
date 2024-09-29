<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request){
        $data=$request->all();
        $data['password']=Hash::make($data['password']);
        if(!$user=User::create($data)){
            return response()->json([
                'message'=>'não tem usuario'
            ]);
        }
        Auth::login($user);
        return $user;
    }
}
