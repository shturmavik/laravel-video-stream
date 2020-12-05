<?php

namespace App\Http\Middleware;

use Closure;

class CheckPin
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
        if ($request->cookie('access') === 'pass' || !!$request->get('email_hash')) {
            return $next($request);
        }
        return redirect(route('pin.create'))->withCookie(
            'section',
            $request->getRequestUri(),
            1,
            '/pin/store',
            request()->getHost(),
            true,
            false
        );
    }
}
