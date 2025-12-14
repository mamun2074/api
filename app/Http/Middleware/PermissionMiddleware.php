<?php

namespace App\Http\Middleware;

use App\Facades\AppResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!config('permissions-config.rolepermission-enable')) {
            return $next($request);
        }
        $routeName = $request->route()->getName();

        if ($request->user()->hasPermission($routeName)) {
            return $next($request);
        }

        return AppResponse::sendPermissionError();
    }
}
