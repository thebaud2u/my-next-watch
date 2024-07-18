<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // return route('login');

            $intended = $request->fullUrl();
            $action = $request->route()->getAction();

            if (! empty($action['controller']) && str_contains($action['controller'], 'Space\\Registered')) {
                return route('login').'?'.http_build_query(['r' => $intended]);
            } else {
                return route('login', ['userType' => 'applicant']).'?'.http_build_query(['r' => $intended]);
            }
        }
    }
}
