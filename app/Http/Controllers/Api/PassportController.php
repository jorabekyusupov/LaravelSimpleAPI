<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiLoginRequest;
use App\Http\Requests\ApiRegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function register(ApiRegisterUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);
        // dd($data);
        $user = User::create($data);

        $token = $user->createToken('authtoken')->accessToken;
        return response()->json(['user' => $token]);
    }
    public function login(ApiLoginRequest $request)
    {
        $data = $request->validated();
       
        if (!auth()->attempt($data)) {
            return response()->json([
                'success' => false,
                'data' => $data,
                'msg' => 'Error: email or password '
            ]);
        }

        $token = auth()->user()->createToken('authtoken')->accessToken;
        return response()->json(['user' => $token]);
    }
}
