<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Session;

class RedirectIfCms
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  string|null  $guard
	 * @return mixed
	 */
	public function handle($request, Closure $next, $guard = 'cms')
	{
		//dd(Session::all());
	    if (Auth::guard($guard)->check()) {
	        return redirect('cms/dashboard');
	    }

	    return $next($request);
	}
}