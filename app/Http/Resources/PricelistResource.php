<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PricelistResource extends JsonResource
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
            'bprice' => $this->bprice,
            'operational' => $this->operational,
            'facility' => $this->facility,
            'salary' => $this->salary,
            'margin' => $this->margin,
            'discount' => $this->discount,
            'commission' => $this->commission,
            'sprice' => $this->sprice,
            'ops_plus' => $this->operational + $this->facility + $this->salary,
            'mrg_plus' => $this->margin + $this->discount + $this->commission,
            $this->mergeWhen($this->type === 'item', [
                'item' => [
                    'text' => optional($this->item)->name,
                    'value' => optional($this->item)->id
                ],

                'item_id' => optional($this->item)->id,
            ]),
            'segment' => [
                'text' => optional($this->segment)->name,
                'value' => optional($this->segment)->id,
            ],
            $this->mergeWhen($this->type === 'package', [
                'details' => PricelistDetail::collection($this->items),
            ]),
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
