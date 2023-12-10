<?php

namespace App\Services\Api\V1\Users\Role\Interfaces;

interface RoleServiceInterface
{
    public function getAll(int $page);

    public function getByName(string $name);
}
