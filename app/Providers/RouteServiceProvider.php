<?php

namespace App\Providers;

// /route/web.phpを呼び出し、ルーティングのマップを定義するコード

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    // public const HOME = '/dashboard';
    public const STUDENT_HOME = '/myinfo/show';
    public const ADMIN_HOME = '/admin';
    public const TEACHER_HOME = '/teacher';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            //生徒用
            //prefix→urlの接頭辞をグループ化して設定
            Route::middleware('web')
                ->as('student.')
                ->group(base_path('routes/student.php'));

            //管理者用
            Route::prefix('admin')
                ->as('admin.')
                ->middleware('web')
                // ->namespace($this->namespace)
                ->group(base_path('routes/admin.php'));

            //講師用
            Route::prefix('teacher')
                ->as('teacher.')
                ->middleware('web')
                // ->namespace($this->namespace)
                ->group(base_path('routes/teacher.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
