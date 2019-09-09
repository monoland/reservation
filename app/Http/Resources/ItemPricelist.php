<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemPricelist extends JsonResource
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
            'name' => $this->name,
            'type' => $this->type,
            $this->mergeWhen($this->type === 'item', [
                'bprice' => $this->bprice,
                'mprice' => $this->commission + $this->discount + $this->facility + $this->margin + $this->operational + $this->salary,
                'sprice' => $this->sprice,
            ]),
            $this->mergeWhen($this->pivot, [
                'bprice' => optional($this->pivot)->price,
                'mprice' => 0,
                'sprice' => optional($this->pivot)->price,
            ]),
            'commission' => $this->commission,
            'discount' => $this->discount,
            'facility' => $this->facility,
            'margin' => $this->margin,
            'operational' => $this->operational,
            'salary' => $this->salary,
            'segment' => [
                'text' => $this->segment->name,
                'value' => $this->segment->id
            ],
            'venue' => [
                'text' => $this->venue->name,
                'value' => $this->venue->id
            ],
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
