<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarShowRequest;
use App\Http\Resources\CarShowResource;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function show(CarShowRequest $request) {
        // Продолжить тут
        $mark = $request->query('mark');
        $model = $request->query('model');

        $cars = Car::where('mark', $mark)->OrWhere('title', $model)->get();
        return ['data' => ['items' => CarShowResource::collection($cars)]];
    }
}
