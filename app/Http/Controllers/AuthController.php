<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Services\AuthService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponse;

    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws Exception
     */
    public function google(Request $request)
    {
        $request->validate([
            'token' => 'required',
        ]);

        return $this->response(
            data: $this->service->checkGoogle($request->token, $request->header('Fcm-Token'))
        );
    }

    /**
     * @throws Exception
     */
    public function register(UserRegisterRequest $request)
    {
        return $this->response(
            data: $this->service->register($request->validated(), $request->header('Fcm-Token')),
            message: "You have successfully registered"
        );
    }
}
