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
            if ($request->is('api/*'))
            {
                return response()->json([
                    'error' => 'Not Found',
                ], 404);
            }
            throw $e;
        }
    }
}
