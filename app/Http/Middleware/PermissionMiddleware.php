<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $authGuard = app('auth')->guard($guard);

        if ($authGuard->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }
        $routeName = $request->route()->getName();
        $permissions = session()->get('permissions');
        if(!empty($permissions)){
            if(!in_array($routeName, $permissions)){
                return redirect()->back()->with(['error' => 'Access denied.']);
            }
        } else {
            return redirect()->back()->with(['error' => 'Access denied.']);
        }
        return $next($request);
    }
}
