<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
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
        if (\Auth::guest() ){
            return $next($request);
        }else{
            return redirect(route('nedmin.Index'))->with('error','Erişim Yetkiniz Yok');
        }

        return $next($request);
    }
}
