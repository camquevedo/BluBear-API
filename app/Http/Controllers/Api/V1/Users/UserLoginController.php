<?php

namespace App\Http\Controllers\Api\V1\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Packages\ApiResponse\ApiResponseBuilder;

class UserLoginController extends UserController
{
    public function login(Request $request)
    {
        $properties = [
            'email' => 'email|required',
            'password' => 'required',
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

        $serviceResponse = $this->loginService->login(
            arrayToObject($parameters)
        );
        $data = $serviceResponse->getData();

        if ($serviceResponse->getStatusCode() != Response::HTTP_OK) {
            return ApiResponseBuilder::builder()
                ->withCode($serviceResponse->getStatusCode())
                ->withMessage(config('constants.messages.error.login'))
                ->withData($data)
                ->build();
        }

        return ApiResponseBuilder::builder()
            ->withCode($serviceResponse->getStatusCode())
            ->withMessage(config('constants.messages.success.login'))
            ->withData($data->items)
            ->build();
    }

    public function updatePassword(Request $request, int $id)
    {
        if (Auth::user()->id != $id) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_UNAUTHORIZED)
                ->withMessage(
                    config('constants.messages.error.validation')
                )
                ->withData(null)
                ->build();
        }

        $properties = [
            'password' => 'required',
            'newPassword' => 'required|invalid_password_format',
            'confirmNewPassword' => 'required|same:newPassword',
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

        $serviceResponse = $this->loginService->editPassword(
            $id,
            arrayToObject($parameters)
        );
        $data = $serviceResponse->getData();

        if ($serviceResponse->getStatusCode() != Response::HTTP_OK) {
            return ApiResponseBuilder::builder()
                ->withCode($serviceResponse->getStatusCode())
                ->withMessage(config('constants.messages.error.entityNotUpdated'))
                ->withData($data)
                ->build();
        }

        return ApiResponseBuilder::builder()
            ->withCode($serviceResponse->getStatusCode())
            ->withMessage(config('constants.messages.success.update'))
            ->withData($data->items)
            ->build();
    }

    public function sendResetPasswordEmail(Request $request)
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

    public function resetPassword(Request $request)
    {
        $properties = [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'passwordConfirmation' => 'required|same:password',
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

        $serviceResponse = $this->loginService->resetPassword(
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
