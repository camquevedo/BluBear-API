<?php

namespace App\Repositories\Api\V1\Users\UserRole\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Api\V1\Users\UserRole;

use stdClass;

interface UserRoleRepositoryInterface
{
    public function findAll(): LengthAwarePaginator;

    public function findByUserId(int $id): ?stdClass;

    public function save(UserRole $body): bool;

    public function update(int $user_id, int $role_id, array $entity): bool;

    public function delete(int $user_id, int $role_id): bool;
}
