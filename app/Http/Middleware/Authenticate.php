<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    // Providers/RouteServiceProcider.phpにて「as」で設定したものを使ってる
    protected $admin_route = 'admin.login';
    protected $student_route = 'student.login';
    protected $teacher_route = 'teacher.login';

    // ⇓ログインしてないユーザーがアクセスした時の処理
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::is('admin.*')){
                return route($this->admin_route);
            } elseif(Route::is('student.*')){
                return route($this->student_route);
            } else {
                return route($this->teacher_route);
            }
        }
    }
}
