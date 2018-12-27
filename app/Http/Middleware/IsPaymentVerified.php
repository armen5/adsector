<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class IsPaymentVerified
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
        $today  = date("Y-m-d H:i:s");
        $end_payment = Auth::user()->payment_end_date;
        if (Auth::user() &&  Auth::user()->payment_verified == '1' && ( strtotime($today) < strtotime($end_payment) ) ){
            return $next($request);
        }
        return redirect('/checkout');
    }
}
