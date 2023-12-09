<?php

namespace App\Http\Controllers\Api\V1\Digimons;

use App\Http\Controllers\Controller;
use App\Services\Api\V1\Digimons\Interfaces\DigimonServiceInterface;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

// use Illuminate\Support\Facades\Validator;

use App\Packages\ApiResponse\ApiResponseBuilder;

class DigimonController extends Controller
{
    protected $messageEntityName;

    /** @var DigimonServiceInterface $service */
    protected $service;

    public function __construct(DigimonServiceInterface $service)
    {
        $this->messageEntityName = config('constants.messages.entities.digimon');
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll(Request $request)
    {
        $page = $request->query('page') ?? 0;
        $serviceResponse = $this->service->getAll($page);
        $data = $serviceResponse->getData();

        if ($serviceResponse->getStatusCode() != Response::HTTP_OK) {
            return ApiResponseBuilder::builder()
                ->withCode($serviceResponse->getStatusCode())
                ->withMessage(config('constants.messages.error.entityNotFound'))
                ->withData($data)
                ->build();
        }

        return ApiResponseBuilder::builder()
            ->withCode($serviceResponse->getStatusCode())
            ->withMessage(
                config('constants.messages.success.listAll') .
                    $this->messageEntityName
            )
            ->withData($data->items)
            ->withPagination($data->pagination)
            ->build();
    }

    /**
     * Display the specified resource.
     */
    public function getbyParameter(string|int $parameter)
    {

        $serviceResponse = $this->service->getbyParameter($parameter);
        $data = $serviceResponse->getData();

        if ($serviceResponse->getStatusCode() != Response::HTTP_OK) {
            return ApiResponseBuilder::builder()
                ->withCode($serviceResponse->getStatusCode())
                ->withMessage(config('constants.messages.error.entityNotFound'))
                ->withData($data)
                ->build();
        }

        return ApiResponseBuilder::builder()
            ->withCode($serviceResponse->getStatusCode())
            ->withMessage(
                config('constants.messages.success.list') .
                    $this->messageEntityName
            )
            ->withData($data->items)
            ->build();
    }
}
