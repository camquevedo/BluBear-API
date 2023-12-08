<?php

namespace App\Repositories\Api\V1\Digimons\Interfaces;

use App\Models\Api\V1\Digimons\Digimon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use stdClass;

interface DigimonRepositoryInterface
{   
    public function findAll(int $page): LengthAwarePaginator | stdClass;

    public function findByParameter(string|int $parameter): ?stdClass;
}
