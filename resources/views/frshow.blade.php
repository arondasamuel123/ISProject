@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="card">
            <div class="card-header">
               {{-- {{$gig->gig_name}} --}}
               {{\App\User::where('id', $freelancer->user_id)->pluck('name')->first()}}
            </div>
            <div class="card-body">
              <p class="card-text">{{$freelancer->skills}}</p>
              <p class="card-text">{{$freelancer->bio}}</p>
              <p class="card-text">{{$freelancer->level_type}}</p>
              {{-- <a href="/download/{{$gig->gig_id}}">{{$gig->project_files}}</a><br> --}}
              <br>
              <a href="/messages" class="btn btn-primary">Hire</a>
                {{-- <a href="/bid/{{$gig->gig_id}}" class="btn btn-primary">Submit bid</a> --}}
               
            </div>
            
          </div> 
     
</div>
@endsection 
