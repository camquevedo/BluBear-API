<?php

namespace App\Services\Api\V1\Users;

use App\Services\Api\V1\Users\Interfaces\UserServiceInterface;
use App\Http\Resources\Api\V1\Users\UserResource;
use App\Models\Api\V1\Users\User;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;

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

        static::sendMail(
            NewUserMail::class,
            [$newEntity->email],
            [
                'user' => $newEntity,
            ]
        );

        $accessToken = $this->createAuthToken($newEntity);

        $response = new stdClass();
        $response->items = [
            'user' => $this->createResource($newEntity),
            'token' => $accessToken,
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
            'phone' => $body->details->phone,
            'birthday' => formatDate($body->details->birthday),
            'document_type_id' => $body->details->documentTypeId,
            'document_number' => $body->details->documentNumber,
            'is_receive_emails' => $body->properties->isReceiveEmails,
            'company_name' => $body->company->name,
            'company_document' => $body->company->document,
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
}