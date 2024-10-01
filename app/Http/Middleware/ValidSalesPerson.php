<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Entities\User;

class ValidSalesPerson
{
    /**
     * Handle an incoming request for sales person page and check if the sales person code is valid, if not valid redirect to landing page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $userCode = collect(request()->segments())->last();

        if (!User::whereCode($userCode)->exists()) {
            // Invalid sales person code
            return redirect()->route('home')->with('error', 'Invalid Sales person.');
        }

        return $next($request);
    }
}
