<?php

namespace App\Http\Resources\Api\V1\Digimons;

use Illuminate\Http\Resources\Json\JsonResource;

class DigimonDetailResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? intval($request->id),
            'name' => $this->name,
            'xAntibody' => $this->xAntibody,
            'images' => $this->images,
            'levels' => $this->levels,
            'types' => $this->types,
            'attributes' => $this->attributes,
            'fields' => $this->fields,
            'releaseDate' => $this->releaseDate,
            'descriptions' => $this->descriptions,
            'skills' => $this->skills,
            'priorEvolutions' => $this->priorEvolutions,
            'nextEvolutions' => $this->nextEvolutions
        ];
    }
}
