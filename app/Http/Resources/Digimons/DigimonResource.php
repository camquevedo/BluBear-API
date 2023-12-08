<?php

namespace App\Http\Resources\Digimons;

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
