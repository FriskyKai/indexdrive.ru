<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\BookingCreateRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function create(BookingCreateRequest $request) {
        $user = new User($request->client);
        $user->password = 'userpassword';


        return response()->json($user)->setStatusCode(200, 'Добавлено');
    }
}
