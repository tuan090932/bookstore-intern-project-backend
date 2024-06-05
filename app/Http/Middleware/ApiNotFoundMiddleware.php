<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ApiNotFoundMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try
        {
            return $next($request);
        }
        catch (NotFoundHttpException $e)
        {
            if ($request->is('127.0.0.1/*' || 'localhost/*'))
            {
                return response()->json([
                    'error' => 'Not Found'
                ], 404);
            }
            throw $e;
        }
    }
}
