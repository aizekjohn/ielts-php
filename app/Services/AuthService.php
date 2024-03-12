<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AuthService
{
    /**
     * Validates google oauth token
     *
     * @param string $token
     * @param string|null $fcmToken
     * @return array
     * @throws Exception
     */
    public function checkGoogle(string $token, ?string $fcmToken): array
    {
        $response = Http::get('https://www.googleapis.com/oauth2/v3/userinfo', [
            'access_token' => $token,
        ])->json();

        if (array_key_exists('email', $response) && $response['email_verified']) {
            $email = $response['email'];

            $user = User::where('email', $email)->first();

            if (is_null($user)) {
                Cache::set($email, [
                    'token' => $token,
                    'fcm' => $fcmToken,
                ], 300);

                return [
                    'action' => 'register',
                    'email' => $email,
                    'name' => $response['name'] ?? '',
                ];
            }

            if ($user->tokens()->exists()) {
                $user->tokens()->delete();
            }

            $token = $user->createToken($fcmToken ?? $email);

            return [
                'action' => 'login',
                'access_token' => $token->plainTextToken,
            ];
        }

        throw new Exception('Invalid Google oAuth token, please try again...');
    }
}
