<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @throws Exception
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requiredHeaders = ['Device-Name', 'App-Version', 'Device-Platform', 'Fcm-Token'];

        foreach ($requiredHeaders as $header) {
            if (!$request->hasHeader($header)) {
                throw new Exception("Missing required header: " . $header);
            }
        }

        // Updating fcm token and platform in case it's changed on mobile side
        if (auth()->user() && (auth()->user()->fcm_token != $request->header('Fcm-Token') || auth()->user()->platform != $request->header('Device-Platform'))) {
            auth()->user()->update([
                'fcm_token' => $request->header('Fcm-Token'),
                'platform' => $request->header('Device-Platform'),
            ]);
        }

        return $next($request);
    }
}
