<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VenueResource extends JsonResource
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
            'address' => $this->address,
            'employees_count' => $this->employees_count,
            'monetizes_count' => $this->monetizes_count,
            'pricelists_count' => $this->pricelists_count,
            'packages_count' => $this->packages_count,
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
