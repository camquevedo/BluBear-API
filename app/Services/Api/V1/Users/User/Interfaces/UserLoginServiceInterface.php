<?php

namespace App\Services\Api\V1\Users\User\Interfaces;

interface UserLoginServiceInterface
{
    public function login(object $body);

    public function editPassword(int $id, object $body);

    public function sendResetPasswordEmail(object $body);

    public function resetPassword(object $body);
}
