@extends('layouts.app')

@section('content')
@foreach ($checklists as $checklist)
    
<div class="card">
        <div class="card-header">
                {{\App\Gigs::where('gig_id', $checklist->gig_id)->pluck('gig_name')->first()}}
           </div>
           <div class="card-body">
                   <ul id="myUL">
                   <form method="POST" action="/checked">
                    @csrf
                   <input  name="done" onclick="this.form.submit()" type="checkbox" {{$checklist->done ? 'checked': ''}}/> 
                   <input type="hidden" name="id" value="{{$checklist->id}}"/>
                   {{$checklist->milestone}}
                   </form>      
                         </ul>
                         
                         <form action="/mdelete/{{$checklist->id}}" method="POST">
                                @method("DELETE")
                                @csrf
                            {{-- <a href="/pdelete/{{$p->id}}" class="btn btn-danger">Delete Project</a>  --}}
                            <button type="submit" class="btn btn-danger">Delete Milestone</button>
                              </form>
           </div>
         </div>
         
         @endforeach
         <div class="form-group" style="text-align:center">
                        <a style="cursor:pointer" href="/cdashboard" class="btn btn-primary">BACK</a>
                    </div>
@endsection