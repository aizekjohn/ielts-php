<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    public function response(
        int $httpCode = null,
        array $data = [],
        string $message = '',
        array $errors = [],
        int $code = 0,
    ): JsonResponse
    {
        return response()->json([
            'status' => is_null($httpCode), // if http code something other than 200 then it the status is false
            'message' => $message,
            'errors' => $errors,
            'data' => $data,
            'code' => $code,
        ], $httpCode ?? Response::HTTP_OK);
    }
}
