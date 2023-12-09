<?php

namespace App\Repositories\Api\V1\Users\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

use App\Models\Api\V1\Users\User;

use stdClass;

interface UserRepositoryInterface
{
    public function findAll(): LengthAwarePaginator;

    public function findById(int $id): ?stdClass;

    public function findByEmail(string $email): ?stdClass;

    public function findPasswordById(int $id): ?stdClass;

    public function save(User $body): bool;

    public function update(int $id, array $entity): bool;

    public function delete(int $id): bool;
}
