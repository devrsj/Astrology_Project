<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {


        if(Auth::check()){
     
            if(auth()->user()->is_admin==1){
                return $next($request);
            }else{
        return redirect(url('/'))->with("success","You don't have admin access.");
            }

        }
       
        return $next($request);



    }
}
