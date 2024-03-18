<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserService
{
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
}
