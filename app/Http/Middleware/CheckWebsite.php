<?php

namespace App\Http\Middleware;

use Closure;
use App\Website;

class CheckWebsite
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
    	$website = Website::where('address', $_SERVER['SERVER_NAME'])->with('region','speciality')->first();
    	if ($website) {
			$request->session()->put('website', $website);
			return $next($request);
		}
    	else return response('Unregistered website!', 403);
    }
}
