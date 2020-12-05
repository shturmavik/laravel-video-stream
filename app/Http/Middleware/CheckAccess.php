<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SetSuccess;
use Closure;

class CheckAccess
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
        $getSuccess = new SetSuccess();
        $getSuccess->show($request->email_hash, $request->section);
        return $next($request);
    }
}
