<?php

namespace App\Exceptions;

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
                return response()->json([
                    'message' => "Invalid API endpoint, make sure you are sending `Accept` header with `application/json` value"
                ], Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof ThrottleRequestsException) {
                return response()->json([
                    'message' => 'Too many attempts, please, try again later'
                ], Response::HTTP_TOO_MANY_REQUESTS);
            }

            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'message' => 'No record found for your request',
                ], Response::HTTP_NOT_FOUND);
            }

            if ($e instanceof QueryException) {
                return response()->json([
                    'message' => 'There was an error while connecting to database, our engineers will soon fix the problem',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return response()->json([
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ], Response::HTTP_BAD_REQUEST);
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

        return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function unauthenticated($request, AuthenticationException $exception): JsonResponse
    {
        return response()->json([
            'message' => 'Unauthenticated',
        ], Response::HTTP_UNAUTHORIZED);
    }
}
