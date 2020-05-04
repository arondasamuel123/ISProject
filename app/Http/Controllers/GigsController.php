<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gigs;

class GigsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $gigs = Gigs::where('user_id', "=", $id)->get();

        return view('cshow', compact('gigs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gigs');
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
            'gig_name' => 'required',
            'gig_description' => 'required',
            'gig_duration' => 'required',
            'gig_payment' => 'required'
          ]);
          
          $user= Auth::user();
          $user->gigs()->create([
                'gig_name'=> $request->gig_name,
                 'gig_description'=> $request->gig_description,
                 'gig_duration'=> $request->gig_duration,
                 'gig_payment'=> $request->gig_payment

                         ]);

            return redirect()->to('/cdashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        if($user->user_type=="Freelancer") {
            $gig = Gigs::findOrFail($id);
            return view('show',compact('gig'));
        } elseif($user->user_type=="Client") {
            $gig = Gigs::findOrFail($id);
            return view('gshow',compact('gig'));
        }
    }
    public function gshow($id)
    {
            $gig = Gigs::findOrFail($id);
            return view('show',compact('gig'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
        $gig = Gigs::find($id);
        
        return view('cedit', compact('gig'));
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
        $this->validate($request, [
            'gig_name' => 'required',
            
            
            ]);
        $gig= Gigs::findOrFail($id);
        $gig->gig_name = $request->gig_name;
        $gig->gig_description = $request->gig_description;
        $gig->gig_payment = $request->gig_payment;
        $gig->gig_duration= $request->gig_duration;
        $gig->is_complete = $request->is_complete;
        $gig->save();

        if($gig->is_complete== 1) {
            return view('payment');
        } else {
            return redirect()->to('/cdashboard')
                ->with('flash_message', 'Update successful')
                ->with('flash_type', 'alert-success');
        }


        // if ($gig->save() ){
        //     return redirect()->to('/cdashboard')
        //     ->with('flash_message', 'Update successful')
        //     ->with('flash_type', 'alert-success');
        // }else if($gig->is_complete == 1) {
        //     return view('payment');
        // } else {
        //     return $gig;
        // }
        

        // return redirect()->to('/cdashboard');

        

            // $gig = new Gigs;
            // $gig->gig_name = request('gig_name');
            // $gig->gig_description = request('gig_description');
            // $gig->gig_payment = request('gig_payment');
            // $gig->gig_duration = request('gig_duration');
            // $gig->is_complete = request('is_complete');
            // $gig->update();

            // return $gig;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gig = Gigs::findOrFail($id);
        
        $gig->delete();
        return redirect()->to('/cdashboard')
        ->with('flash_message', 'Gig Deleted')
        ->with('flash_type', 'alert-danger');
    }
   
}
