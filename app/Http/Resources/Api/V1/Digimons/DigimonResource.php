<?php

namespace App\Http\Resources\Api\V1\Digimons;

use Illuminate\Http\Resources\Json\JsonResource;

class DigimonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? intval($request->id),
            'name' => $this->name,
            'href' => $this->href,
            'image' => $this->image
        ];
    }
}
