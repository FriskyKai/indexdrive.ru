<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiRequest;
use App\Http\Requests\UserCreateRequest;
use App\Http\Resources\UserProfileResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function create(UserCreateRequest $request) {
        $user = new User($request->all());
        $user->save();
        return response()->json($user)->setStatusCode(200, 'Добавлено');
    }

    public function show(ApiRequest $request) {
        $user = Auth::user();

        return new UserProfileResource($user);
    }
}
