<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponse;

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

    protected $dontReport = [
        //
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, Request $request) {
            if ($e instanceof ValidationException) {
                return $this->invalidJson($request, $e);
            }

            if ($e instanceof AuthenticationException) {
                return $this->unauthenticated($request, $e);
            }

            if ($e instanceof RouteNotFoundException) {
                return $this->response(
                    httpCode: Response::HTTP_NOT_FOUND,
                    message: 'Invalid API endpoint, make sure you are sending `Accept` header with `application/json` value'
                );
            }

            if ($e instanceof ThrottleRequestsException) {
                return $this->response(
                    httpCode: Response::HTTP_TOO_MANY_REQUESTS,
                    message: 'Too many attempts, please, try again later'
                );
            }

            if ($e instanceof NotFoundHttpException) {
                return $this->response(
                    httpCode: Response::HTTP_NOT_FOUND,
                    message: 'No record found for your request'
                );
            }

            if ($e instanceof QueryException) {
                return $this->response(
                    httpCode: Response::HTTP_INTERNAL_SERVER_ERROR,
                    message: 'There was an error while connecting to database, our engineers will soon fix the problem'
                );
            }

            return $this->response(
                httpCode: Response::HTTP_BAD_REQUEST,
                message: $e->getMessage(),
                code: $e->getCode(),
            );
        });
    }

    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        $errors = [];

        foreach ($exception->errors() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'field' => $field,
                    'message' => $message,
                ];
            }
        }

        $response = [
            'message' => 'Validation error',
            'errors' => $errors,
        ];

        return $this->response(
            httpCode: Response::HTTP_UNPROCESSABLE_ENTITY,
            message: 'Validation error',
            errors: $errors
        );
    }

    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse
    {
        return $this->response(
            httpCode: Response::HTTP_UNAUTHORIZED,
            message: 'Unauthenticated'
        );
    }
}
