<?php

namespace ControleDeHoras\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AutorizacaoMiddleware {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {

		if (!$request->is('login') && Auth::guest()) {
			return redirect('/login');
		}

		return $next($request);
	}

}
