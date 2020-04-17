<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ApiUserAuth
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
        if($request->has('api_token') && $request->api_token !== null)
        {
            $user = User::where('api_token', '=', $request->api_token)->first();

            if($user !== null)
            {
                return $next($request);
            }
        }

        return response()->json("not auth");
    }
}
