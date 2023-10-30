<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        $path = $request->path();
        if(($path == "login" ) && Session::get('key') ){
            return redirect('/');
        }
        else if(($path != "login" ) && !Session::get('key')){
            return redirect('login');
        }
       
        return $next($request);
    }
}
