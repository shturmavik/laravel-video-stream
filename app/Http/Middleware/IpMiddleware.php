<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\IpUtils;

class IpMiddleware
{
    protected $ipRanges = [
        'IP_ADDRESS',
    ];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach ($request->getClientIps() as $ip) {
            if (!$this->isValidIpRange($ip)) {
                abort(404);
            }
        }

        return $next($request);
    }

    protected function isValidIpRange($ip)
    {
        return IpUtils::checkIp($ip, $this->ipRanges);
    }
}
