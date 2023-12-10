<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;

use App\Packages\ApiResponse\ApiResponseBuilder;

use Illuminate\Http\Response;

use App\Traits\LogsTrait;

use stdClass;
use Throwable;

class Handler extends ExceptionHandler
{
    use LogsTrait;
    
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, \Throwable $exception)
    {
        $data = new stdClass();
        $data->file = $exception->getFile();
        $data->line = $exception->getLine();
        $data->trace = $exception->getTrace();

        if ($exception instanceof AuthenticationException) {
            static::saveLog(
                'AUTH_ERROR',
                [$data],
                $exception->getMessage()
            );

            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_UNAUTHORIZED)
                ->withMessage($exception->getMessage())
                ->withData(null)
                ->build();
        }

        if ($exception instanceof BaseException) {
            static::saveLog(
                'ERROR',
                [$data],
                $exception->getResponseContext()->error
            );

            return ApiResponseBuilder::builder()
                ->withCode($exception->getResponseCode())
                ->withMessage($exception->getResponseMessage())
                ->withData($exception->getResponseContext())
                ->build();
        }

        static::saveLog(
            'CRITICAL_ERROR',
            [$data],
            $exception->getMessage()
        );

        return ApiResponseBuilder::builder()
            ->withCode(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->withMessage($exception->getMessage())
            ->withData($data)
            ->build();
    }
}
