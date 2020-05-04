<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use App\User;
use App\Bid;
use App\Freelancer;

use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    //    $users= User::where('user_type', 'Freelancer')->with('portfolios')->get();
    //     return view('',compact('users'));
    // //     return $users;
       $user = Auth::user();
       $portfolios = Portfolio::where('user_id',$user->id)->get();
       return view('vportfolio',compact('portfolios'));
       //return $portfolios;

            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portfolio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )
    {

        $this->validate($request, [
            'project_url' => 'required',
            'overview' => 'required',
            ]);
            
            $user = Auth::user();
            $user->portfolios()->create([
            'project_url'=> $request->project_url,
             'overview'=> $request->overview
                     ]);
                $freelancer = Freelancer::where('user_id', $user->id)->first();

                if($freelancer->status == 1) {

                return redirect()->to('/vportfolio')
            ->with('flash_message', 'Portfolio added')
                ->with('flash_type', 'alert-success');

                } else {
                    return redirect()->to('/portfolio')
                    ->with('flash_message', 'Portfolio added')
                        ->with('flash_type', 'alert-success');
                }
            

            
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
        $portfolio= Portfolio::findOrFail($id);
        $portfolio->delete();

        return redirect()->to('/fdashboard')
        ->with('flash_message', 'Project deleted')
        ->with('flash_type', 'alert-info');
    }
    
}
