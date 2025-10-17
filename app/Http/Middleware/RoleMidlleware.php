<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!in_array($request->user()->role, $roles)) {
            // Jika user tidak memiliki peran yang sesuai
            abort(403, 'Akses ditolak. Kamu tidak memiliki izin untuk membuka halaman ini.');
        }

        return $next($request);
    }
}
