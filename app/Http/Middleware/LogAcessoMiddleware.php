<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LogAcessor;

class LogAcessoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request ->server->get('REMOTE_ADDR');
        $rota = $request->getRequestUri();
        LogAcessor::create(['log' => 'IP xyz requisitou a rota abcd']);

         return $next($request);

        
    }
}
