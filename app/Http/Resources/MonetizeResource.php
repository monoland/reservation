<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MonetizeResource extends JsonResource
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
            'id' => $this->id,
            'type' => $this->type,
            'commission' => $this->commission,
            'discount' => $this->discount,
            'facility' => $this->facility,
            'managerfee' => $this->managerfee,
            'margin' => $this->margin,
            'marketfee' => $this->marketfee,
            'operational' => $this->operational,
            'salary' => $this->salary,
            'venuefee' => $this->venuefee,
            'segment' => [
                'text' => $this->segment->name,
                'value' => $this->segment->id,
            ],
            'venue_id' => $this->venue_id,
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
