<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('admin_login')) {
            return redirect('/login')->with('error', 'Silakan login dulu');
        }

        return $next($request);
    }
}