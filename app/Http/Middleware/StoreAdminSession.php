<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreAdminSession
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
        if (Auth::guard('admin')->check())
        {
            $admin = Auth::guard('admin')->user();
            DB::table('session')->insert([
                'session_id' => session()->getId(),
                'admin_id' => $admin->id,
                'expiration' => now()->addMinutes(config('session.lifetime')),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return $next($request);
    }
}
