<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Auth;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         if (Auth::user() && Auth::user()->is_customer) {
    //             return route('front.login-client');
    //         } else {
    //             return route('login');
    //         }
    //     }
    // }

    public function handle($request, Closure $next, ...$guards)
    {
        $guard = $guards[0] ?? null;

        // dd(Auth::user());
        if (!Auth::guard($guard)->check()) {
            // Redirect to appropriate login page based on guard
            switch ($guard) {
                case 'admin':
                    // dd('admin');
                    return redirect()->route('login');
                case 'client':
                    // dd('client');
                    return redirect()->route('front.login-client');
                default:
                    // dd('default');
                    return redirect()->route('login');
            }
        }

        return $next($request);
    }
}
