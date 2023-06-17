<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;

class CheckTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    use ApiResponse;
    public function handle(Request $request, Closure $next)
    {
        $split_header = explode(' ',$request->header('Authorization'));
        $token = $split_header[1] ?? null;
        if(!$token){
            return $this->INVALID_ACCESS_TOKEN();
        }
        $user = User::where('access_token',$token)->first();
        if(!$user){
            return $this->INVALID_LOGIN();
        }
        $request->currentUser = $user;
        return $next($request);
    }
}
