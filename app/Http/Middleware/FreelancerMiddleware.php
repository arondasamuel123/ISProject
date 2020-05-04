<?php

namespace App\Http\Middleware;

use Closure;
use App\Freelancer;
use Auth;

class FreelancerMiddleware
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
        $user = Auth::user();
        $id = $user->id;
        $freelancer = Freelancer::where('user_id', $id)->first();
        if (!$freelancer)
        {
            //dd($request->user()->user_type);
            return response('Not approved', 401);
        }
        return $next($request);
        
    }
}
