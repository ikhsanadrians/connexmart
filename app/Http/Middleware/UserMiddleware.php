<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;



class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check()){
            return redirect()->route('login');
        }

    //     if(Auth::user()->role_id != 4){
    //         if(Auth::user()->role_id == 1){
    //             return redirect()->route('admin.index');
    //         } else if (Auth::user()->role_id == 2){
    //             return redirect()->route('bank.index');
    //         } else if (Auth::user()->role_id == 3){
    //             return redirect()->route('mart.index');
    //         }
    //     }  

        return $next($request);
    }
}
