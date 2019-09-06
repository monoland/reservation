<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PricelistDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            $this->mergeWhen($this->pivot, [
                'text' => $this->pivot->name,
                'price' => $this->pivot->price,
                'value' => $this->id,
            ]),
        ];
    }
}
