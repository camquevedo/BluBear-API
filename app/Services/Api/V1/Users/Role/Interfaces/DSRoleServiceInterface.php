<?php

namespace App\Services\Api\V1\Users\Role\Interfaces;

interface DSRoleServiceInterface
{
    public function findAll();

    public function findByName(string $name);
}
