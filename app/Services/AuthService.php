<?php

namespace App\Services;

use App\Enums\UserStatus;
use App\Events\UserAuthorized;
use App\Events\UserRegistered;
use App\Models\User;
use App\Traits\FileUpload;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AuthService
{
    use FileUpload;

    /**
     * Validates google oauth token
     *
     * @param string $token
     * @param string|null $fcmToken
     * @param string|null $platform
     * @return array
     * @throws Exception
     */
    public function checkGoogle(string $token, ?string $fcmToken, ?string $platform): array
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

            if ($user->fcm_token != $fcmToken || $user->platform != $platform) {
                $user->update([
                    'fcm_token' => $fcmToken,
                    'platform' => $platform,
                ]);
            }

            event(new UserAuthorized($user));

            $token = $this->createUserToken($user, $fcmToken ?? $email);

            return [
                'action' => 'login',
                'access_token' => $token,
            ];
        }

        throw new Exception('Invalid Google oAuth token, please try again...');
    }

    /**
     * @param array $attributes
     * @param string|null $fcmToken
     * @param string|null $platform
     * @return array
     * @throws Exception
     */
    public function register(array $attributes, ?string $fcmToken, ?string $platform): array
    {
        $cachedData = Cache::get($attributes['email']);

        if (is_null($cachedData) || $cachedData['token'] != $attributes['token']) {
            throw new Exception('Session is expired, please try signing in again');
        }

        if (array_key_exists('avatar', $attributes)) {
            $avatar = $this->uploadSingleFile($attributes['avatar'], 'avatars');
            $attributes['avatar'] = $avatar['path'];
        }

        if (array_key_exists('referrer', $attributes)) {
            $referrerCode = $attributes['referrer'];
            $referrer = User::where('referral_code', $referrerCode)->first();
            $attributes['referrer_id'] = $referrer?->id;
        }

        $attributes['fcm_token'] = $fcmToken;
        $attributes['platform'] = $platform;
        $user = User::create($attributes);
        Cache::delete($user->email);

        event(new UserRegistered($user));

        $token = $this->createUserToken($user, $user->fcm_token ?? $user->email);

        return [
            'access_token' => $token,
        ];
    }

    private function createUserToken(User $user, string $fcm): string
    {
        if ($user->tokens()->exists()) {
            $user->tokens()->delete();
        }

        $token = $user->createToken($fcm);

        return $token->plainTextToken;
    }
}
