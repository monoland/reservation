<?php

namespace App\Http\Resources;

use App\Models\Item;
use App\Models\Segment;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PricelistCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return PricelistResource::collection($this->collection);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'additional' => [
                'items' => Item::fetchCombo(),
                'segments' => Segment::fetchCombo()
            ]
        ];
    }
}
