<?php

namespace App\Http\Resources\Api\V1\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? intval($request->id),
            'name' => $this->name
        ];
    }
}
