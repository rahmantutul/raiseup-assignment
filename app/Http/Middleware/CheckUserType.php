<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class CheckUserType
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
        if (auth()->guard('admin')->user()->type == 'admin') {
            return $next($request);
        }else{
            Toastr::error('You are not permitted for this route!','Sorry');
            return redirect()->back(); die;
        }
    }
}
