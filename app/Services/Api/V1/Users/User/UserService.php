<?php

namespace App\Services\Api\V1\Users\User;

use App\Services\Api\V1\Users\User\Interfaces\UserServiceInterface;
use App\Http\Resources\Api\V1\Users\UserResource;
use App\Models\Api\V1\Users\User;
use App\Models\Api\V1\Users\UserRole;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;

use stdClass;

use App\Traits\RecaptchaTrait;
use App\Traits\MailingTrait;

use App\Mail\Api\V1\NewUserMail;

class UserService extends DSUserService implements UserServiceInterface
{
    use RecaptchaTrait, MailingTrait;

    private function createModel()
    {
        return new User();
    }

    public function createResource(object $entity)
    {
        return new UserResource($entity);
    }

    private function createResourceCollection(Collection $entities)
    {
        return UserResource::collection($entities);
    }

    public function validateRecaptcha(string $token): bool
    {
        if (!static::recaptcha($token)) {
            return false;
        }
        return true;
    }

    public function createAuthToken($user)
    {
        return $user->createToken('authToken')->plainTextToken;
    }

    public function getAll()
    {
        $foundEntities = $this->findAll();

        if (!$foundEntities) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $this->createResourceCollection(
            collect($foundEntities->items())
        );
        $response->pagination = paginate($foundEntities);

        return response()->json($response, Response::HTTP_OK);
    }

    public function getById($id)
    {
        $entity = $this->findById($id);
        if (!$entity) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $this->createResource($entity);

        return response()->json($response, Response::HTTP_OK);
    }

    public function getByEmail($email)
    {
        $entity = $this->findByEmail($email);
        if (!$entity) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $this->createResource($entity);

        return response()->json($response, Response::HTTP_OK);
    }

    public function create($body)
    {
        if (!$this->validateRecaptcha($body->token ?? '')) {
            return response()->json(
                config('constants.messages.error.recaptcha'),
                Response::HTTP_UNAUTHORIZED
            );
        }

        $body->properties->password = bcrypt($body->properties->password);
        unset($body->properties->passwordConfirmation);

        $newEntity = $this->createModel();
        $newEntity->first_name = $body->details->firstName;
        $newEntity->last_name = $body->details->lastName;
        $newEntity->email = $body->details->email;
        $newEntity->password = $body->properties->password;
        
        $role = $this->findRoleByName('user');

        $isSaved = DB::transaction(function () use ($newEntity, $role) {
            $isSaved = $this->save($newEntity);

            $newUserRole = new stdClass();
            $newUserRole->role_id = $role->id;
            $newUserRole->user_id = $newEntity->id;

            $isSavedUserRole = $this->saveUserRole($newUserRole);
            return $isSaved && $isSavedUserRole;
        });
        $newEntity->role = $role;

        if ($isSaved) {
            event(new Registered($newEntity));
            static::sendMail(
                NewUserMail::class,
                [$newEntity->email],
                [
                    'user' => $newEntity,
                ]
            );
    
            $accessToken = $this->createAuthToken($newEntity);
        }

        $response = new stdClass();
        $response->items = [
            'user' => $isSaved ? $this->createResource($newEntity) : null,
            'token' => $accessToken ?? null,
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function edit($id, $body)
    {
        if ($id != auth()->user()->id)
            return response()->json(null, Response::HTTP_UNAUTHORIZED);

        $entity = [
            'first_name' => $body->details->firstName,
            'last_name' => $body->details->lastName,
        ];

        $isUpdated = $this->update($id, $entity);
        if (!$isUpdated) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = arrayToObject($entity);

        return response()->json($response, Response::HTTP_OK);
    }

    public function editPassword($id, $body)
    {
        $entity = [
            'password' => $body->password,
        ];

        $isUpdated = $this->update($id, $entity);
        if (!$isUpdated) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $this->createResource(arrayToObject($entity));

        return response()->json($response, Response::HTTP_OK);
    }

    public function remove($id)
    {
        if ($id != auth()->user()->id)
            return response()->json(null, Response::HTTP_UNAUTHORIZED);

        $isDeleted = $this->delete($id);
        if (!$isDeleted) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $isDeleted;

        return response()->json($response, Response::HTTP_OK);
    }

    public function testEmail()
    {

        $newEntity = $this->createModel();
        $newEntity->first_name = "Camilo";
        $newEntity->last_name = "Tester";
        $newEntity->email = "camquevedo@hotmail.com";
        $newEntity->password = "meh";

        $mailStatus = static::sendMail(
            NewUserMail::class,
            [$newEntity->email],
            [
                'user' => $newEntity,
            ]
        );

        $response = new stdClass();
        $response->items = [
            'mailStatus' => $mailStatus,
            'message' => "Envio de mensaje preparado",
            'token' => "nah" ?? null,
        ];

        return response()->json($response, Response::HTTP_CREATED);
    }
}