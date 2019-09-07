<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MarketingResource extends JsonResource
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
            'phone' => $this->phone,
            'email' => $this->email,
            'describe' => $this->describe,
            'employee' => [
                'text' => $this->employee->name,
                'value' => $this->employee->id,
            ],
            'customers_count' => $this->customers_count,
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
