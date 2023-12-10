<?php

namespace App\Services\Api\V1\Users\UserRole\Interfaces;

interface UserRoleServiceInterface
{
    public function getAll();

    public function getByUserId(int $user_id);

    public function create(object $body);

    public function edit(int $user_id, int $rol_id, object $body);

    public function remove(int $user_id, int $rol_id);
}
