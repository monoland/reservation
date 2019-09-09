<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
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
            'segment' => [
                'text' => $this->segment->name,
                'value' => $this->segment->id,
            ],
            'marketing' => [
                'text' => $this->marketing->name,
                'value' => $this->marketing->id,
            ],
            'address' => $this->address,
            'province' => [
                'text' => $this->province->name,
                'value' => $this->province->id,
            ],
            'regency' => [
                'text' => $this->regency->name,
                'value' => $this->regency->id,
            ],
            'district' => [
                'text' => $this->district->name,
                'value' => $this->district->id,
            ],
            'label' => [
                'text' => optional($this->label)->name,
                'value' => optional($this->label)->id,
            ],
            'phone' => $this->phone,
            'contact_name' => $this->contact_name,
            'contact_phone' => $this->contact_phone,
            'email' => $this->email,
            'checked' => $this->checked,
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
