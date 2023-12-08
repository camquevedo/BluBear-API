<?php

namespace App\Services\Api\V1\Digimons\Interfaces;

interface DigimonServiceInterface
{
    public function getAll(int $page);

    public function getByParameter(string|int $parameter);
}
