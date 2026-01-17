<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            Session::flush();
            return redirect()->route('sign-in')->with('error', 'Please login to continue');
        }
        $user = Auth::user();
        if (!$user->id) {
            Auth::logout();
            Session::flush();
            return redirect()->route('sign-in')->with('error', 'Session expired or logged in from another device');
        }
        if ($request->isMethod('post') && !$request->has('_token')) {
            abort(419);
        }
        return $next($request);
    }
}
