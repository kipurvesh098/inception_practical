<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminMiddleware
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
		if(Auth::check() && Auth::user()->eUserRole == ADMIN_ROLE){
			return $next($request);
		}
		else {
			return redirect()->route('admin.login');
		}
		return $next($request);
	}
}