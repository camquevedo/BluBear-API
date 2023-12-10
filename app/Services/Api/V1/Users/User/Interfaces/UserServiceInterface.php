<?php

namespace App\Services\Api\V1\Users\User\Interfaces;

interface UserServiceInterface
{
    public function getAll();

    public function getById(int $id);

    public function getByEmail(string $email);

    public function create(object $body);

    public function edit(int $id, object $body);

    public function remove(int $id);
}
