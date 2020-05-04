@extends('layouts.app')

@section('content')
<div class="container">
@foreach($bids as $bid)

<div class="card">
    <div class="card-header">
        {{\App\User::where('id', $bid->user_id)->pluck('name')->first()}}
    </div>
    <div class="card-body">
      
    
    <h5 class="card-title">{{\App\Gigs::where('gig_id', $bid->g_id)->pluck('gig_name')->first()}}</h5>
    <p class="card-text">{{$bid->project_period}}</p>
      <p class="card-text">{{$bid->cover_letter}}</p>
      <p class="card-text">ksh{{$bid->amount}}</p>
    <a href="/ebid/{{$bid->id}}" class="btn btn-primary">Select bid</a>
    <a href="/fportfolio/{{$bid->id}}" class="btn btn-success">View Profolio</a>
     
      
    </div>
  
    
    @endforeach
  </div>


  
</div>
@endsection