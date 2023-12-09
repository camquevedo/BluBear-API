<?php

namespace App\Services\Api\V1\Digimons;

use App\Services\Api\V1\Digimons\Interfaces\DigimonServiceInterface;
use App\Http\Resources\Api\V1\Digimons\DigimonResource;
use App\Http\Resources\Api\V1\Digimons\DigimonDetailResource;
use App\Models\Api\V1\Digimons\Digimon;

use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use stdClass;

class DigimonService extends DSDigimonService implements DigimonServiceInterface
{
    private function createModel()
    {
        return new Digimon();
    }

    private function createResource(object $entity)
    {
        return new DigimonDetailResource($entity);
    }

    private function createResourceCollection(Collection $entities)
    {
        return DigimonResource::collection($entities);
    }

    public function getAll($page)
    {
        $foundEntities = $this->findAll($page);
        if (!$foundEntities) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $this->createResourceCollection(
            // collect($foundEntities->items())
            collect($foundEntities->content)
        );
        // $response->pagination = paginate($foundEntities);
        $response->pagination = $foundEntities->pageable;

        return response()->json($response, Response::HTTP_OK);
    }

    public function getByParameter(string|int $parameter)
    {
        $entity = $this->findByParameter($parameter);
        if (!$entity) {
            return response()->json(null, Response::HTTP_NOT_FOUND);
        }

        $response = new stdClass();
        $response->items = $this->createResource($entity);

        return response()->json($response, Response::HTTP_OK);
    }
}
