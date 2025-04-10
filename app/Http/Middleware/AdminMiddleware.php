<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->isAdmin()) {
            return $next($request);
        } else {
            return \response()->json(['Message' => 'You don\'t have permission to access this page.']);
        }
    }


}
