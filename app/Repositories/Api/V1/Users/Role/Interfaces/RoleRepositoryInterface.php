<?php

namespace App\Repositories\Api\V1\Users\Role\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Api\V1\Users\Role;

use stdClass;

interface RoleRepositoryInterface
{
    public function findAll(): LengthAwarePaginator;

    public function findById(int $id): ?stdClass;

    public function findByName(string $name): ?stdClass;

    public function save(Role $body): bool;

    public function update(int $id, array $entity): bool;

    public function delete(int $id): bool;
}
