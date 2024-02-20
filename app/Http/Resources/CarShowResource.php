<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $request->id,
            'mark' => $request->mark,
            'title' => $request->title,
            'car_number' => $request->car_number,
            'branch_id' => $request->branch_id,
            'price' => $request->price,
            'branch' => $request->branch
        ];
    }
}
