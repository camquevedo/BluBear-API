<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Packages\ApiResponse\ApiResponseBuilder;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $userRole = Auth::user()
            ->roles()
            ->pluck('name')
            ->toArray();

        try {
            $rolesConfig = config("constants.roles.access.$role");
        } catch (\Throwable $th) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_FORBIDDEN)
                ->withMessage(
                    "Unauthorized, role $role does not have configuration"
                )
                ->build();
        }

        if (!array_intersect($rolesConfig, $userRole)) {
            return ApiResponseBuilder::builder()
                ->withCode(Response::HTTP_FORBIDDEN)
                ->withMessage("Unauthorized, you must to be an $role to access")
                ->build();
        }

        return $next($request);
    }
}