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
            'id' => $this->id,
            'mark' => $this->mark,
            'title' => $this->title,
            'car_number' => $this->car_number,
            'branch_id' => $this->branch_id,
            'price' => $this->price,
            'branch' => $this->branch
        ];
    }
}
