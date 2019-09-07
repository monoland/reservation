<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
            'customers_count' => $this->customers_count,
            'regencies_count' => $this->regencies_count,
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
