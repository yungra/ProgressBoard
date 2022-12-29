<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    // config/auth.phpで設定したものを使う
    private const GUARD_ADMIN = 'admin';
    private const GUARD_STUDENT = 'students';
    private const GUARD_TEACHER = 'teachers';
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // $guards = empty($guards) ? [null] : $guards;

        // foreach ($guards as $guard) {
        //     if (Auth::guard($guard)->check()) {
        //         return redirect(RouteServiceProvider::HOME);
        //     }
        // }

        if(Auth::guard(self::GUARD_ADMIN)->check() && $request->routeIs('admin.*')){
            return redirect(RouteServiceProvider::ADMIN_HOME);
        }

        if(Auth::guard(self::GUARD_STUDENT)->check() && $request->routeIs('student.*')){
            return redirect(RouteServiceProvider::STUDENT_HOME);
        }

        if(Auth::guard(self::GUARD_TEACHER)->check() && $request->routeIs('teacher.*')){
            return redirect(RouteServiceProvider::TEACHER_HOME);
        }

        return $next($request);
    }
}
