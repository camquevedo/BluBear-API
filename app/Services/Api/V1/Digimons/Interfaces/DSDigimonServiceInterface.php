<?php

namespace App\Services\Api\V1\Digimons\Interfaces;

interface DSDigimonServiceInterface
{
    public function findAll(int $page);

    public function findByParameter(string|int $parameter);
}
