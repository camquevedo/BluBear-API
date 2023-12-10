<?php

namespace App\Services\Api\V1\Users\User;

use App\Services\Api\V1\Users\User\Interfaces\UserLoginServiceInterface;

use stdClass;
use App\Exceptions\BaseException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class UserLoginService extends UserService implements UserLoginServiceInterface
{
    public function login($body)
    {
        if (!$this->validateRecaptcha($body->token ?? '')) {
            return response()->json(
                config('constants.messages.error.recaptcha'),
                Response::HTTP_UNAUTHORIZED
            );
        }

        try {
            if (!Auth::attempt(['email' => $body->email, 'password' => $body->password])) {
                return response()->json(
                    config('constants.messages.error.login'),
                    Response::HTTP_UNAUTHORIZED
                );
            }
        } catch (\Throwable $e) {
            $messageException = $e->getMessage();

            static::saveLog(
                'LOGIN_' . $this->actionCode,
                [__FUNCTION__, $body],
                $messageException
            );

            throw new BaseException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                config('constants.messages.error.login'),
                $messageException
            );
        }

        $user = Auth::user();

        if (!$user || $user->deleted_at !== null) {
            return response()->json(null, Response::HTTP_UNAUTHORIZED);
        }

        $entity = $this->getById($user->id)->getData()->items;

        if (!$entity) {
            return response()->json(null, Response::HTTP_UNAUTHORIZED);
        }

        $accessToken = $this->createAuthToken($user);

        $response = new stdClass();
        $response->items = [
            'user' => $entity,
            'token' => $accessToken,
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    public function editPassword($id, $body)
    {
        $entity = $this->findPasswordById($id);
        if (!$entity) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        if (
            !Hash::check($body->password, $entity->password) ||
            $body->newPassword != $body->confirmNewPassword
        ) {
            return response()->json(
                config('constants.messages.error.login'),
                Response::HTTP_BAD_REQUEST
            );
        }

        $updateEntity = [
            'password' => bcrypt($body->newPassword),
        ];

        $isUpdated = $this->update($id, $updateEntity);
        if (!$isUpdated) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = null;

        return response()->json($response, Response::HTTP_OK);
    }

    public function sendResetPasswordEmail($body)
    {
        $entity = $this->findByEmail($body->email);
        if (!$entity) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $status = Password::sendResetLink((array) $body);

        $response = new stdClass();
        $response->items = [
            'email' => $entity->email,
        ];

        return $status == Password::RESET_LINK_SENT
            ? response()->json($response, Response::HTTP_OK)
            : response()->json(null, Response::HTTP_BAD_REQUEST);
    }

    public function resetPassword($body)
    {
        $status = Password::reset((array) $body, function ($user, $password) {
            $user
                ->forceFill([
                    'password' => Hash::make($password),
                ])
                ->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        });

        $response = new stdClass();
        $response->items = [
            'email' => $body->email,
        ];

        return $status == Password::PASSWORD_RESET
            ? response()->json($response, Response::HTTP_OK)
            : response()->json(null, Response::HTTP_BAD_REQUEST);
    }
}