<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Freelancer;
use Illuminate\Support\Facades\Auth;
use App\User;
use Mail;

class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Freelancer::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $freelancer = Freelancer::findOrFail($id);

        $user = User::where('id', $freelancer->user_id)->first();

        //$freelancer->update($request->all());

        if($freelancer->update($request->all())) {
            $freelancer = Freelancer::findOrFail($id);
            if($freelancer->status== 1) {
                Mail::send('email', ['user' => $user, 'freelancer' => $freelancer], function ($message) use ($user)
                {
                  $message->from('info@studentgigs', 'StudentGigs Support');
                  $message->to($user->email, $user->name);
               });
            } elseif($freelancer->status== 2){
                Mail::send('rejected', ['user' => $user, 'freelancer' => $freelancer], function ($message) use ($user)
                {
                  $message->from('info@studentgigs', 'StudentGigs Support');
                  $message->to($user->email, $user->name);
               });
            }

           

        }


        
        
        return ['message' =>'Freelancer details updated'];
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
