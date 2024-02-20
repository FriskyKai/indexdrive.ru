<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return response()->json($users)->setStatusCode(200, 'Успешно');
    }

    public function create(UserCreateRequest $request) {
        $user = new User($request->all());
        $user->save();
        return response()->json($user)->setStatusCode(200, 'Добавлено');
    }
}
