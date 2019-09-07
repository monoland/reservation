<?php

namespace App\Http\Resources;

use App\Models\Label;
use App\Models\Province;
use App\Models\Segment;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CustomerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return CustomerResource::collection($this->collection);
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
                'provinces' => Province::fetchCombo(),
                'segments' => Segment::fetchCombo(),
                'labels' => Label::fetchCombo()
            ]
        ];
    }
}
