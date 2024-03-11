<?php

namespace App\Http\Middleware;

use App\Models\AppRelease;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class AddVersionHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $platform = $request->header('Device-Platform');

        $versions = Cache::get('app_release_' . $platform);

        if (is_null($versions)) {
            $latestVersion = AppRelease::select(['version', 'update_required'])
                ->where('platform', $platform)
                ->latest('release_date')
                ->first();

            $latestForceVersion = $latestVersion;

            if (!$latestVersion?->update_required) {
                $latestForceVersion = AppRelease::select(['version', 'update_required'])
                    ->where('platform', $platform)
                    ->where('update_required', true)
                    ->latest('release_date')
                    ->first();
            }

            $versions = [
                'latest' => $latestVersion?->version,
                'forced' => $latestForceVersion?->version,
            ];
        }

        if (!is_null($versions['latest'])) {
            Cache::set('app_release_' . $platform, $versions);

            $response->header('X-Latest-Version', $versions['latest']);
            $response->header('X-Latest-Force-Version', $versions['forced']);
        }


        return $response;
    }
}
