<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class EnsureApiKeyValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if ($request->header("api-key")==env('API_KEY', 'dGhzaSBpcyBhIHRlc3QgYXBwIAo='))
        {
            return $next($request);
        }
        else
        {
            return  response(array([
                "message"=>"Please provide valid app key"
            ]),400);
        }

    }
}
