<?php

namespace App\Services;

use App\Models\User;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Support\Facades\Storage;

class UserService
{
    use FileUpload;

    /**
     * @throws Exception
     */
    public function generateRefCode(User $user): string
    {
        if (!is_null($user->referral_code)) {
            return $user->referral_code;
        }

        $attempts = 0;

        do {
            $referralCode = $this->generateRandomString();
            $attempts++;
        } while (User::where('referral_code', $referralCode)->exists() && $attempts < 20);

        if ($attempts == 20) {
            throw new Exception('Failed to generate referral code, please try again later');
        }

        $user->update([
            'referral_code' => $referralCode,
        ]);

        return $referralCode;
    }

    private function generateRandomString(): string
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ($i = 0; $i < config('constants.referral_code_length'); $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $code;
    }

    public function removeAvatar(User $user): void
    {
        $avatarPath = $user->avatar;

        if (is_null($avatarPath)) {
            return;
        }

        $user->update([
            'avatar' => null,
        ]);

        Storage::delete($avatarPath);
    }

    public function editProfile(?array $attributes, User $user): void
    {
        if (array_key_exists('avatar', $attributes)) {
            $avatar = $this->uploadSingleFile($attributes['avatar'], 'avatars');
            $attributes['avatar'] = $avatar['path'];

            if (!is_null($user->avatar)) {
                Storage::delete($user->avatar);
            }
        }

        $user->update($attributes);
    }
}
