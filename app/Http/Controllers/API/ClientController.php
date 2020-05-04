<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\User;
use Mail;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::latest()->paginate(10);
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
        $client = Client::findOrFail($id);
        $file= public_path()."/storage/".$client->company_cert;
        return response()->download($file);
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
        $client = Client::findOrFail($id);
        $user = User::where('id', $client->user_id)->first();

        if($client->update($request->all())){
            $client = Client::findOrFail($id);
            if($client->status==1) {
                Mail::send('cemail', ['user' => $user, 'client' => $client], function ($message) use ($user)
                {
                  $message->from('info@studentgigs', 'StudentGigs Support');
                  $message->to($user->email, $user->name);
               });
            } elseif($client->status==2) {
                Mail::send('rejected', ['user' => $user, 'client' => $client], function ($message) use ($user)
                {
                  $message->from('info@studentgigs', 'StudentGigs Support');
                  $message->to($user->email, $user->name);
               });

            }
            }
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
