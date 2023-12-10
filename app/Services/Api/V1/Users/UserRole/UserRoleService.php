<?php

namespace App\Services\Api\V1\Users\UserRole;

use App\Services\Api\V1\Users\UserRole\Interfaces\UserRoleServiceInterface;
use App\Http\Resources\Api\V1\Users\RoleResource;
use App\Models\Api\V1\Users\UserRole;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use stdClass;

class UserRoleService extends DSUserRoleService implements UserRoleServiceInterface
{
    private function createModel()
    {
        return new UserRole();
    }

    private function createResource(object $entity)
    {
        return new RoleResource($entity);
    }

    private function createResourceCollection(Collection $entities)
    {
        return RoleResource::collection($entities);
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

    public function getByUserId($user_id)
    {
        $entity = $this->findByUserId($user_id);
        if (!$entity) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $this->createResource($entity);

        return response()->json($response, Response::HTTP_OK);
    }

    public function create($body)
    {
        $newEntity = $this->createModel();
        $newEntity->user_id = $body->user_id;
        $newEntity->role_id = $body->role_id;

        $isSaved = $this->save($newEntity);

        $response = new stdClass();
        $response->items = $isSaved ? $this->createResource($newEntity) : null;

        return response()->json($response, Response::HTTP_CREATED);
    }

    public function edit($user_id, $role_id, $body)
    {
        $entity = [
            'user_id' => $body->user_id,
            'role_id' => $body->role_id,
        ];

        $isUpdated = $this->update($user_id, $role_id, $entity);
        if (!$isUpdated) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = arrayToObject($entity);

        return response()->json($response, Response::HTTP_OK);
    }

    public function remove($user_id, $role_id)
    {
        $isDeleted = $this->delete($user_id, $role_id);
        if (!$isDeleted) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $isDeleted;

        return response()->json($response, Response::HTTP_OK);
    }
}
