<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    protected string $user_login_route  = 'public.login';
    protected string $admin_user_login_route = 'admin.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if (Route::is('public.*')) {
                return route($this->user_login_route);
            } elseif (Route::is('admin.*')) {
                return route($this->admin_user_login_route);
            }
        }
    }
}
