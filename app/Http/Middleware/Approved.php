<?php

namespace App\Http\Middleware;

use Closure;
use App\Freelancer;
use Illuminate\Support\Facades\Auth;

class Approved
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
        $user= Auth::user;
        $id = $user->id;
        $freelancer = Freelancer::where('user_id', "=", $id)->first();

        if(!$freelancer->status == 1 && $user->user_type == "Freelancer" ){
            
            return "Freelancer has not been approved";
        }
        //return redirect()->to('/freelancer')
    //   ->with('flash_message', 'You have been successfully approved.')
	//   ->with('flash_type', 'alert-success');
        return $next($request);
    }
}
