<?php

namespace App\Http\Middleware;

use Closure;

class ForceJson
{
    public function handle($request, Closure $next)
    {
        $request->headers->add(['accept' => 'application/json']);
        return $next($request);
    }
}
