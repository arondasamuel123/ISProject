<?php

namespace App\Http\Controllers;

use App\Checklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gigs;
use Illuminate\Support\Facades\Storage;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  Auth::user();
       $id = $user->id;
       
       $checklists = Checklist::where('user_id', $id)->get();
       return view('vtodo', compact('checklists'));
         // dd($milestones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('todo');
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
       $id = $user->id;

        $gig = Gigs::latest()->first();
        $gid = $gig->gig_id;

        $checklist =new Checklist();
        $checklist->user()->associate($id);
        $checklist->gig()->associate($gid);
        $checklist->milestone = $request->milestone;
        $checklist->save();

        //return "Milestone successfully added";

        return redirect()->to('/todo/create')
        ->with('flash_message', 'Milestone successfully added')
        ->with('flash_type', 'alert-success');
        // if($checklist->save()) {s
        //     return view('todo',compact('checklist'));
        // } else {
        //     return "This doesnt work";
        // }
        
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

    public function checked(Request $request) {
            $id = $request->id;
            $userid = Auth::user()->id;
            //return $id;
            $checklist = Checklist::findOrFail($id);
            if($checklist->user_id == $userid) {
                $checklist->mark();

            }
            
            return redirect()->to('/todos');

    }
    /**
     * Remove the specified resource from storage.
     *return redirect()->to('/cdashboard')
        ->with('flash-message', 'Milestone Deleted')
        ->with('flash_type', 'alert-danger');
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $milestone = Checklist::findOrFail($id);
        $milestone->delete();

        return redirect()->to('/todos')
        ->with('flash_message', 'Milestone deleted')
        ->with('flash_type', 'alert-danger');   
    }

    public function submit(Request $request){
        $id = $request->id;
        $gig= Gigs::findorFail($id);
        //$name = $request->project_files->getClientOriginalName();
        $gig->project_files = $request->project_files->store('uploads','public');
        $gig->save();
        //return redirect()->to('vbid');
        return redirect()->to('/fdashboard')
        ->with('flash_message', 'Project files submitted')
        ->with('flash_type', 'alert-success');     
}
public function download($id) {
    $gig = Gigs::findOrFail($id);
    $file= public_path()."/storage/".$gig->project_files;
    //return $file;

    // $headers = array(
    //           'Content-Type: application/pdf',
    //         );
    //$path = public_path('storage/uploads/',$gig->project_files);
    return response()->download($file);
}
}
