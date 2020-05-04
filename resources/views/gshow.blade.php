@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="card">
            <div class="card-header">
               {{$gig->gig_name}}
            </div>
            <div class="card-body">
              
            
           
              <p class="card-text">{{$gig->gig_description}}</p>
              <p class="card-text">ksh{{$gig->gig_payment}}</p>
              <p class="card-text">{{$gig->gig_duration}}</p>
              <a href="/download/{{$gig->gig_id}}">{{$gig->project_files}}</a><br>
              {{-- <a href="/download/{{$gig->gig_id}}">{{$gig->project_files}}</a><br> --}}
              <br>

              <a href="/cedit/{{$gig->gig_id}}" class="btn btn-primary">Update Gig</a>
            <a href="/cdelete/{{$gig->gig_id}}" class="btn btn-danger">Delete Gig</a>
            </div>
            
          </div> 
          <a href="/cdashboard" class="btn btn-primary">Back</a>
</div>
@endsection 
