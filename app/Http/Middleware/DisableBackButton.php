<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Response;

class DisableBackButton
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //dd('Debug message');
        //return $next($request);
        if (!Auth::check()) {
            // If the user is not authenticated, redirect to the login page
            return redirect('/login');
        }
        $response = $next($request);
        $response->headers->set('Cache-Control','nocache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Pragma','no-cache');
        $response->headers->set('Expires','Thu, 28 Dec 2023 00:00:00 GMT');
        return $response;
    }
}
