<?php

namespace App\Services\Api\V1\Users\Interfaces;

interface DSUserServiceInterface
{
    public function findAll();

    public function findById(int $id);

    public function findByEmail(string $email);

    public function findPasswordById(int $id);

    public function save(object $body);

    public function update(int $id, array $body);

    public function delete(int $id);
}
