@extends('layouts.app')

@section('content')
@foreach ($checklists as $checklist)
    
<div class="card">
        <div class="card-header">
                {{\App\Gigs::where('gig_id', $checklist->gig_id)->pluck('gig_name')->first()}}
           </div>
           <div class="card-body">
                   <ul id="myUL">
                   <form method="POST" action="/fchecked">
                    @csrf
                   <input  name="done" onclick="this.form.submit()" type="checkbox" {{$checklist->done ? 'checked': ''}}/> 
                   <input type="hidden" name="id" value="{{$checklist->id}}"/>
                   {{$checklist->milestone}}
                   </form>      
                         </ul>
         
             {{-- <a href="#" class="btn btn-primary">Edit</a>
             <a href="#" class="btn btn-danger">Delete</a> --}}
          
           </div>
         </div>
         @endforeach
         <br>
         
         <form method="POST" action="/submit" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <input type="hidden" name="id" value="{{$checklist->gig_id}}"/>
                        <label for="name">Upload Project files:(if any)</label>
                        <input  type="file" name="project_files"  multiple data-preview-file-type="any" class="form-control">
                       
                    </div>
                    <div class="form-group">
                                <button style="cursor:pointer" type="submit" class="btn btn-success">Submit Project</button>
                            </div>
         </form>
         <br>
         <br>
         <br>
         <a href="/fbids" class="btn btn-primary">Back</a>

@endsection