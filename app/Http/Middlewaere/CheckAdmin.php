<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('admin_login')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}