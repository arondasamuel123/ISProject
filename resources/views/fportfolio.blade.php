@extends('layouts.app')

@section('content')
<div class="container">

@foreach($portfolios as $p)
<div class="card">
    <div class="card-header">
        {{\App\User::where('id', $p->user_id)->pluck('name')->first()}}
    </div>
    <div class="card-body">
      
    
    <h5 class="card-title">{{$p->overview}}</h5>
      <p class="card-text">{{$p->project_url}}</p>
      
    
     
      
    </div>
    @endforeach
    
   
  </div>


  
</div>
<a href="/bshow" class="btn btn-primary">Back</a> 
@endsection