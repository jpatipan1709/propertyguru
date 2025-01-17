<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckRegisterMiddleware
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
        if(Session::get('confirm') == "" || Session::get('confirm') == null){
            return redirect('thankyou');
        }
        return $next($request);
    }
}
