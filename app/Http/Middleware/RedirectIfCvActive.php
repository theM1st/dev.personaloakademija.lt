<?php namespace App\Http\Middleware;

use Closure;
use Route;

class RedirectIfCvActive {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		// If admin redirect to cv index
		if (\Auth::user()->isAdminWorker()) {
			return $next($request);
		}

        $cv = \Auth::user()->cv()->first();

        if ($cv && $cv->state == 0) {
            return redirect()->route('cv_show', [$cv->id]);
        }

		return $next($request);
	}

}
