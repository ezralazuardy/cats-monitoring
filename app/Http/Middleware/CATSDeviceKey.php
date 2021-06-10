<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CATSDeviceKey
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset($request->key) && password_verify(env('CATS_DEVICE_KEY'), $request->key))
            return $next($request);
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }
}
