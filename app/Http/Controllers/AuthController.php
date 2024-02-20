<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request) {
        $user = User::where('phone', $request->phone)->where('password', $request->password)->first();

        if ($user) {
            Auth::user($user);
            $user->api_token = Hash::make(microtime(true)*1000);
            $user->save();
            return response()->json($user->api_token)->setStatusCode(200, 'OK');
        } else {
            throw new ApiException(401, 'Unauthorized');
        }
    }

    public function logout(Request $request) {
        $user = $request->user();
        $user->api_token = null;
        $user->save();
        return response()->json('Выход')->setStatusCode(200, 'OK');
    }
}
