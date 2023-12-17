<?php

namespace App\Http\Controllers\Api\V1\Users;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Validator;

use App\Packages\ApiResponse\ApiResponseBuilder;

use App\Services\Api\V1\Users\User\Interfaces\UserServiceInterface;
use App\Services\Api\V1\Users\User\Interfaces\UserLoginServiceInterface;
use Inertia\Inertia;

class UserController extends Controller
{
    protected $properties = [
        'details.firstName' => 'required|max:55|string',
        'details.lastName' => 'required|max:55|string',
        'details.email' => 'email|required|unique:users,email',
        'properties.password' => 'required|invalid_password_format',
        'properties.passwordConfirmation' => 'required|same:properties.password'
    ];

    protected $messageEntityName;

    /** @var UserServiceInterface $service */
    protected $service;

    /** @var UserLoginServiceInterface $loginService */
    protected $loginService;

    public function __construct(
        UserServiceInterface $service,
        UserLoginServiceInterface $loginService
    ) {
        $this->messageEntityName = config('constants.messages.entities.user');
        $this->service = $service;
        $this->loginService = $loginService;
    }

    /**
     * Display a listing of the resource.
     */
    public function getAll(Request $request)
    {
        $serviceResponse = $this->service->getAll();
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
    public function getById(int $id)
    {
        if ($id != auth()->user()->id) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_UNAUTHORIZED)
                ->withMessage(config('constants.messages.error.entityNotOwned'))
                ->build();
        }

        $serviceResponse = $this->service->getById($id);
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

    public function getByParameter(Request $request)
    {
        $parameters = $request->only(['email', 'phone', 'id']);
        $validator = Validator::make($parameters, [
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
            'id' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_BAD_REQUEST)
                ->withMessage(config('constants.messages.error.validation'))
                ->withData($validator->errors())
                ->build();
        }

        $serviceResponse = null;

        if (array_key_exists('email', $parameters)) {
            $serviceResponse = $this->service->getByEmail($parameters['email']);
        } elseif (array_key_exists('id', $parameters)) {
            $serviceResponse = $this->getById($parameters['id']);
        }

        $data = $serviceResponse ? $serviceResponse->getData() : null;

        if (
            !$serviceResponse ||
            $serviceResponse->getStatusCode() != Response::HTTP_OK
        ) {
            return ApiResponseBuilder::builder()
                ->withCode(
                    $serviceResponse
                        ? $serviceResponse->getStatusCode()
                        : Response::HTTP_NOT_FOUND
                )
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
            ->build();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $parameters = $request->only(array_keys($this->properties));
        $validator = Validator::make($parameters, $this->properties);
        if ($validator->fails()) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_BAD_REQUEST)
                ->withMessage(config('constants.messages.error.validation'))
                ->withData($validator->errors())
                ->build();
        }

        $serviceResponse = $this->service->create(arrayToObject($parameters));
        $data = $serviceResponse->getData();

        if ($serviceResponse->getStatusCode() != Response::HTTP_CREATED) {
            return ApiResponseBuilder::builder()
                ->withCode($serviceResponse->getStatusCode())
                ->withMessage(
                    config('constants.messages.error.entityNotCreated')
                )
                ->withData($data)
                ->build();
        }

        return ApiResponseBuilder::builder()
            ->withCode($serviceResponse->getStatusCode())
            ->withMessage(
                config('constants.messages.success.save') .
                    $this->messageEntityName
            )
            ->withData($data->items)
            ->build();
    }

    public function store () {
        return Inertia::render('Users/Create');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $remove = [
            'details.email',
            'properties.password',
            'properties.passwordConfirmation',
        ];
        $properties = $this->properties;
        $customProperties = array_diff_key($properties, array_flip($remove));

        $parameters = $request->only(array_keys($customProperties));
        $validator = Validator::make($parameters, $customProperties);
        if ($validator->fails()) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_BAD_REQUEST)
                ->withMessage(config('constants.messages.error.validation'))
                ->withData($validator->errors())
                ->build();
        }

        $serviceResponse = $this->service->edit(
            $id,
            arrayToObject($parameters)
        );
        $data = $serviceResponse->getData();

        if ($serviceResponse->getStatusCode() != Response::HTTP_OK) {
            return ApiResponseBuilder::builder()
                ->withCode($serviceResponse->getStatusCode())
                ->withMessage(
                    config('constants.messages.error.entityNotUpdated')
                )
                ->withData($data)
                ->build();
        }

        return ApiResponseBuilder::builder()
            ->withCode($serviceResponse->getStatusCode())
            ->withMessage(
                config('constants.messages.success.update') .
                    $this->messageEntityName
            )
            ->withData($data->items)
            ->build();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, int $id)
    {
        if ($id == config('constants.global.defaultUserId')) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_BAD_REQUEST)
                ->withMessage(
                    config('constants.messages.error.entityNotDeleted')
                )
                ->withData(null)
                ->build();
        }

        $serviceResponse = $this->service->remove($id);
        $data = $serviceResponse->getData();

        if ($serviceResponse->getStatusCode() != Response::HTTP_OK) {
            return ApiResponseBuilder::builder()
                ->withCode($serviceResponse->getStatusCode())
                ->withMessage(
                    config('constants.messages.error.entityNotDeleted')
                )
                ->withData($data)
                ->build();
        }

        return ApiResponseBuilder::builder()
            ->withCode($serviceResponse->getStatusCode())
            ->withMessage(
                config('constants.messages.success.delete') .
                    $this->messageEntityName
            )
            ->withData($data->items)
            ->build();
    }

    public function verificateMail(Request $request)
    {
        $properties = [
            'email' => 'email|required'
        ];

        $parameters = $request->only(array_keys($properties));
        $validator = Validator::make($parameters, $properties);
        if ($validator->fails()) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_BAD_REQUEST)
                ->withMessage(config('constants.messages.error.validation'))
                ->withData($validator->errors())
                ->build();
        }

        $serviceResponse = $this->loginService->sendResetPasswordEmail(
            arrayToObject($parameters)
        );
        $data = $serviceResponse->getData();

        if ($serviceResponse->getStatusCode() != Response::HTTP_OK) {
            return ApiResponseBuilder::builder()
                ->withCode($serviceResponse->getStatusCode())
                ->withMessage(config('constants.messages.error.general'))
                ->withData($data)
                ->build();
        }

        return ApiResponseBuilder::builder()
            ->withCode($serviceResponse->getStatusCode())
            ->withMessage(config('constants.messages.success.general'))
            ->withData($data->items)
            ->build();
    }
}
