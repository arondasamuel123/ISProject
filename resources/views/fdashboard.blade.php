@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/search" method="POST">
        @csrf
        <input type="text" name="query"/>
        <input type="submit" class="btn btn-sm btn-success" value="Search" />
    </form>
    <br>
  
@foreach($users as $user)
@foreach($user->gigs as $gig)
@if($gig->is_complete== 0)
<div class="row">
<div class="col-sm-12">
<div class="card border-primary mb-3">
    <div class="card-header">
       {{$user->name}}
    </div>
    <div class="card-body">
    <h5 class="card-title">{{$gig->gig_name}}</h5>
      <p class="card-text">{{$gig->gig_description}}</p>
      <p class="card-text">ksh{{$gig->gig_payment}}</p>
      <p class="card-text">{{$gig->gig_duration}}</p>
    <a href="/bid/{{$gig->gig_id}}" class="btn btn-primary">Submit bid</a>
     
      
    </div>
    @endif
    
  </div>
</div>
</div>
  @endforeach
    
  @endforeach

  
</div>
@endsection