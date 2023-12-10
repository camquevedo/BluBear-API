<?php

namespace App\Services\Api\V1\Users\UserRole\Interfaces;

interface DSUserRoleServiceInterface

{
    public function findAll();

    public function findByUserId(int $user_id);

    public function save(object $body);

    public function update(int $user_id, int $rol_id, array $body);

    public function delete(int $user_id, int $rol_id);
}
