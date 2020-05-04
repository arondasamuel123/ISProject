<?php

namespace App\Http\Controllers;

use App\Bid;
use Illuminate\Http\Request;

use App\Gigs;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Portfolio;


class BidController extends Controller
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
        $bids = Bid::where('user_id', "=", $id)->get();
        return view('fbid', compact('bids'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)

    {
        return view('bid', compact('id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $user = Auth::user();
           $id= $user->id;





           $bid = new Bid();
           $bid->project_period = $request->project_period;
           $bid->user()->associate($id);
           $bid->g_id = $request->id;
           $bid->cover_letter = $request->cover_letter;
           $bid->amount = $request->amount;
           $bid->save();

           return redirect()->to('/fdashboard')
           ->with('flash_message', 'Bid successfully created')
           ->with('flash_type', 'alert-success');






    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       $user =  Auth::user();
       $id = $user->id;
       $gig = Gigs::where('user_id', $id)->first();
       $bids = Bid::where('g_id', $gig->gig_id)->get();


      // return $bids;
      return view('fshow',compact('bids'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bid = Bid::findOrFail($id);

        return view('ebid', compact('bid'));
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
            $bid = Bid::findOrFail($id);
             $bid->status = $request->status;
            $user = User::where('id',$bid->user_id)->first();
            $userid = Auth::user()->id;
            $checklist = User::where('id', $userid)->with('milestones')->first();
            //  return $checklist;

            if($bid->save()) {
                $bid = Bid::findOrFail($id);
                if($bid->status== 1) {
                    Mail::send('bemail', ['user' => $user, 'checklist'=> $checklist->milestones], function ($message) use ($user)
                {
                  $message->from('info@studentgigs', 'StudentGigs Support');
                  $message->to($user->email, $user->name);
                  $message->subject('Accepted Bid');
               });
                }
            }

           //return $bid;
           return redirect()->to('/cdashboard')
           ->with('flash_message', 'Bid Selected')
           ->with('flash_type', 'alert-success');

            // if($bid->save($request->all())) {


            // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bid= Bid::findOrFail($id);
        $bid->delete();
        return redirect()->to('/fdashboard')
        ->with('flash_message', 'Bid Deleted')
        ->with('flash_type', 'alert-danger');
    }

    public function fportfolio($id){
        $bid= Bid::findOrFail($id);
       $user = User::where('id',$bid->user_id)->first();
       $portfolios = Portfolio::where('user_id',$user->id)->get();
       return view('fportfolio',compact('portfolios'));
    }
}
