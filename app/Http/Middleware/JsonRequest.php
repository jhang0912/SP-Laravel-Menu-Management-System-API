<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JsonRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Content-Type') || $request->header('Content-Type') !== 'application/json') {
            return response(['status' => 0, 'msg' => '請求格式錯誤(json)']);
        }
        return $next($request);
    }
}
