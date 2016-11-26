<?php

namespace App\Http\Middleware;

use Closure;
use \Spatie\Menu\Laravel\Menu;

class MenuMiddleware
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
        Menu::macro('main', function () {
            return Menu::new()
                ->addClass('nav navbar-nav')
                ->action('home@displaypage', 'Home')
                ->action('preferences@displaypage', 'Preferences')
                ->action('about@displaypage', 'About')
                ->setActiveFromRequest();
        });

        return $next($request);
    }
}
