<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'authent' => [
                'text' => $this->authent->name,
                'value' => $this->authent->id,
            ],
            'avatar' => $this->avatar,
            'background' => $this->background,
            'theme' => $this->theme,
            'pinned' => false,
            'updated_at' => (string) $this->updated_at,
        ];
    }
}
