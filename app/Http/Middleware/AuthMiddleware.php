<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (currentUser()) {
            return $next($request);
        }
        Session::put('loginRedirect', Request::url());
        if ($request->ajax()){
            return response()->json('error', 401);
        }
        return redirect('/');
    }
}
