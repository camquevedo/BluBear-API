<?php

namespace App\Services\Api\V1\Users\Role;

use App\Services\Api\V1\Users\Role\Interfaces\RoleServiceInterface;
use App\Http\Resources\Api\V1\Users\RoleResource;
use App\Models\Api\V1\Users\Role;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use stdClass;

class RoleService extends DSRoleService implements RoleServiceInterface
{
    private function createModel()
    {
        return new Role();
    }

    private function createResource(object $entity)
    {
        return new RoleResource($entity);
    }

    private function createResourceCollection(Collection $entities)
    {
        return RoleResource::collection($entities);
    }

    public function getAll($page)
    {
        $foundEntities = $this->findAll($page);
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

    public function getByName(string $name)
    {
        $entity = $this->findByName($name);
        if (!$entity) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $this->createResource($entity);

        return response()->json($response, Response::HTTP_OK);
    }
}
