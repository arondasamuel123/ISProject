<?php

namespace App\Http\Middleware;
use App\Client;
use Closure;
use Illuminate\Support\Facades\Auth;

class ClientMiddleware
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
        $client = Client::where('user_id', $id)->first();
        if (!$client)
        {
            //dd($request->user()->user_type);
            return response('Not approved', 401);
        }
        return $next($request);
    }
}
