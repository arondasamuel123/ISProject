<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Freelancer;
use App\User;
use App\Gigs;
use App\Bid;
use App\Checklist;

class FreelancerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_type', 'Client')->with('gigs')->get();
        
        //$users = User::has('gigs')->get();
        //$users = User::with(['clients','gigs'])->get();
        
        return view('fdashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('freelancer');
    }

    public function  mount(Request $request, $id)
    {
        
        // $user = Auth::user();
        // $id = $user->id;
        // $freelancer = Freelancer::where('user_id', "=", $id)->first();
        $freelancer = Freelancer::findOrFail($id);
        $user = User::where('id', $freelancer->user_id)->first();
       //Auth::login($user);

        return redirect()->to('/login');
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
            'skills' => 'required',
            'bio' => 'required',
            'level_type' => 'required'
          ]);
          
          $user= Auth::user();
          $user->freelancers()->create([
                'skills'=> $request->skills,
                 'bio'=> $request->bio,
                 'level_type'=> $request->level_type,

                         ]);
        //   Freelancer::create([
        //       'skills'=> $freelancer['skills'],
        //       'bio' => $freelancer['bio'],
        //       'level_type' => $freelancer['level_type']
  
        //       ]);
        
              return redirect()->to('portfolio');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $freelancer = Freelancer::findOrFail($id);
        return view('frshow', compact('freelancer'));
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
    public function milestones() {
         $user = Auth::user();
         $id = $user->id;
         $bid = Bid::where('user_id', $id)->first();
         $gig = Gigs::where('gig_id', $bid->g_id)->first(); 

        //  return $gig;



         if($bid->status==1 && $bid->g_id==$gig->gig_id) {
            $checklists = Checklist::where('gig_id', $gig->gig_id)->get();
            //return $checklists;
            return view('vbid', compact('checklists'));
         } else {
             return "Youre bid hasn't been selected";
         }

    }
    public function fchecked(Request $request) {
        // $user = Auth::user();
        //  $id = $user->id;
        //  $bid = Bid::where('user_id', $id)->first();
        //  $gig = Gigs::where('gig_id', $bid->g_id)->first();
        $id= $request->id;
        $checklist = Checklist::findOrFail($id);
        $checklist->mark();
        
        return redirect()->to('/milestones');
        //return $id;
         
        //  $checklist = Checklist::where('gig_id', $gig->gig_id)->first();
        //  return $checklist->id;
        //  if($checklists->gig_id == $gig->gig_id) {
        //     $checklists->mark();    

        // }
    }
   
}
