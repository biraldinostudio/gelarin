<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Response;
Use UserDescription;
class CompanyMiddleware
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
        if ($request->user() && $request->user()->type != 'Company')
        {
            return new Response(view('unauthorized')->with('role', 'company'));
        }
        return $next($request);
    }
}
