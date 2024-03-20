<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    private UserService $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function me()
    {
        return $this->response(
            data: UserResource::make(auth()->user())
        );
    }

    /**
     * @throws Exception
     */
    public function generateRefCode()
    {
        $code = $this->service->generateRefCode(auth()->user());

        return $this->response(
            data: [
                'referral_code' => $code,
            ]
        );
    }

    public function removeAvatar()
    {
        $this->service->removeAvatar(auth()->user());

        return $this->response(
            message: "Avatar has been removed successfully"
        );
    }

    public function editProfile(EditProfileRequest $request)
    {
        $this->service->editProfile($request->validated(), auth()->user());

        return $this->response(
            message: "Profile has been updated successfully"
        );
    }

    public function logout()
    {
        $this->service->revokeTokens(auth()->user());

        return $this->response(
            message: "See you later..."
        );
    }
}
