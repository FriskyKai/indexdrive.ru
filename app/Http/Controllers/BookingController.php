<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\ApiRequest;
use App\Http\Requests\BookingCreateRequest;
use App\Http\Resources\BookingActiveResource;
use App\Models\Booking;
use App\Models\BookingCar;
use App\Models\Car;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class BookingController extends Controller
{
    public function create(BookingCreateRequest $request) {
        $openStatusId = Status::where('name', 'open')->first()->id;

        /**
         * Через связь booking ищем не закрытые брони
         */
        $isSomeCarBusy = BookingCar::whereHas('booking', function ($query) use ($openStatusId) {
            $query->where('status', $openStatusId);
        })->count();

        if ($isSomeCarBusy) {
            throw new ApiException(400, 'Некоторые автомобили не свободны для бронирования');
        }

        $phone = $request->client['phone'];

        $user = User::where('phone', $phone)->first();
        $is_new = false;

        if (!$user) {
            $is_new = true;

            $password = Random::generate();
            $user = User::create([
                ...$request->client,
                'password' => $password
            ]);
        }

        $code = Random::generate(5, 'aA-Zz');

        $booking = Booking::create([
            'code' => $code,
            'start_date' => $request->start_date,
            'end_date'=> $request->end_date,
            'status'=> Status::where('name', 'open')->first()->id,
            'user_id'=> $user->id,
        ]);

        foreach ($request->cars as $carId) {
            BookingCar::create([
                'car_id' => $carId,
                'booking_id' => $booking->id,
            ]);
        }

        $data = [
            'code' => $code,
        ];

        if ($is_new) {
            $data['user'] = ['password' => $user->password];
        }

        return $data;
    }

    public function active() {
        $statusId = Status::where('name', 'open')->first()->id;

        $booking = Booking::with('bookingCars')->where('status', $statusId)->get();

        return ['data' => ['items' => BookingActiveResource::collection($booking)]];
    }

    public function show($code) {
        $booking = Booking::where('code', $code)->first();

        if (!$booking) {
            throw new ApiException(404, 'Model not found');
        }

        if (Auth::user()->id != $booking->user_id) {
            throw new ApiException(403, 'Access denied');

        }

        return new BookingActiveResource($booking);
    }

    public function historyShow(ApiRequest $request) {
        $booking = Booking::with('bookingCars')->get();

        return ['data' => ['items' => BookingActiveResource::collection($booking)]];
    }

    public function close($code) {
        $statusId = Status::where('name', 'close')->first()->id;

        $booking = Booking::where('code', $code)->first();

        if (!$booking) {
            throw new ApiException(404, 'Model not found');
        }

        if (Auth::user()->id != $booking->user_id) {
            throw new ApiException(403, 'Access denied');
        }

        if ($booking->status == $statusId) {
            throw new ApiException(403, 'Access denied');
        }

        $booking->status = $statusId;
        $booking->save();

        return ['data' => ['message' => 'Booking closed']];
    }
}
