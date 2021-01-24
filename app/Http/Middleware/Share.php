<?php

namespace App\Http\Middleware;

use App\Pages;
use Closure;
use Illuminate\Support\Facades\View;

class Share
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
        $page = Pages::all()->sortBy('page_must')->first();
        $settings['slug'] = $page['page_slug'];
        view::Share($settings);
        return $next($request);
    }
}
