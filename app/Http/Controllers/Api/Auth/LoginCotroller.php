<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginCotroller extends Controller
{
    public function store(Request $request){
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email', '$request')->firstOrFail();

        if (Hash::check($request->password, $user->password)) {
            return UserResource::make($user);
        }else{
            return response()->json([
                'message' => 'these credentials do not match our records.'
            ], 400);
        }
    }
}
