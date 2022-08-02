<?php

namespace App\Http\Middleware;
use App\Providers\RouteServiceProvider;
use Closure;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;


class Admin extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not admin.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('home');
        }
    }

    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if ($user->is_admin == 0) {
            return redirect()->intended(RouteServiceProvider::HOME);
        } else {
            return $next($request);
        }
    }
}
