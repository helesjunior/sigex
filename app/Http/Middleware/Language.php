<?php

namespace App\Http\Middleware;

use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->setUserLocale();

        return $next($request);
    }

    private function setUserLocale()
    {
        if (isset(backpack_user()->language)) {
            app()->setLocale(backpack_user()->language);
        }
    }
}
