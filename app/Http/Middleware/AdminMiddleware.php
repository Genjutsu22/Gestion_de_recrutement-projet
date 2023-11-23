<?php

namespace App\Http\Middleware;

use App\admin;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();
        if ($path == "app-admin/login" && Session::get('admin')) {
            return redirect('app-admin/home');
        }
    
        if ($path != "app-admin/login" && !Session::get('admin')) {
            return redirect('app-admin/login');
        }
        return $next($request);
    }
}
