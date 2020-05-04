<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $users = User::where('user_type', 'Freelancer')->get();
        // //$freelancer = Freelancer::where('user_id', $users->id)->get();
        // $freelancers = Freelancer::where('user_id',$users->id)
        //     ->with('users')->get();
        
        //$user->freelancers;
       $users = User::where('user_type','Freelancer')->with('freelancers')->get();
        //return $freelancer;
       //$users= User::with('freelancers')->get();
        // return $users;
         //dd($users);
        return view('cdashboard',compact('users'));
        //return $freelancers;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client');
    }

    public function approval(Request $request, $id) {

        $client = Client::findOrFail($id);
        $user = User::where('id', $client->user_id)->first();

        Auth::login($user);

        return view("gigs");
       //return redirect()->to('/login');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'company_name' => 'required',
            'bio' => 'required',
            'kra_pin' => 'required'
          ]);
          if(request()->hasFile('image')) {
              request()->validate([
                'company_cert' => 'file|image|max:5000',
              ]);
              
          }
          
          $user= Auth::user();
          $user->clients()->create([
                'company_name'=> $request->company_name,
                 'bio'=> $request->bio,
                 'kra_pin'=> $request->kra_pin,
                 'company_cert' => $request->company_cert->store('uploads', 'public')

                         ]);
            
            return view('napproval');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
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
