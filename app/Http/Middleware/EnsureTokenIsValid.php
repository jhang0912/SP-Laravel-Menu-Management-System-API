<?php

namespace App\Http\Middleware;

use App\Services\Managers\AuthManagerService;
use Closure;
use Illuminate\Http\Request;

class EnsureTokenIsValid
{
    private $service;

    public function __construct(AuthManagerService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return response(['status' => 0, 'msg' => 'Unauthorized'], 401);
        }

        $token = $request->bearerToken();
        if ($this->service->authorization($token) === false) {
            return response(['status' => 0, 'msg' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
