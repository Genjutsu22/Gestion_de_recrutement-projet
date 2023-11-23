<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\candidat;
class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        candidat::updateExpiredOTP();
        $path = $request->path();
      
        if ($path == "login" && Session::get('candidat')) {
            return redirect('/');
        } 
        
        if ($path == "register") {
            return $next($request);
        }
        if ($path != "login" && !Session::get('candidat')) {
                return redirect('login');
        }
        
        return $next($request);
    }
    
}
