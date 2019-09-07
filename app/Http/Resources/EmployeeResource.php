<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'role' => $this->role,
            $this->mergeWhen($this->role !== 'manager', [
                'venue' => [
                    'text' => optional($this->venue)->name,
                    'value' => optional($this->venue)->id
                ]
            ]),
            $this->mergeWhen($this->role === 'manager', [
                'customers_count' => $this->customers_count,
            ]),
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
