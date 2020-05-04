@extends('layouts.app')

@section('content')
<div class="container">
<form action="/fsearch" method="POST">
        @csrf
        <input type="text" name="query"/>
        <input type="submit" class="btn btn-sm btn-success" value="Search" />
    </form>
    <br>
@foreach($users as $user)
@foreach ($user->freelancers as $freelancer)
@if($freelancer->status==1)

<div class="card">
    

  
    <div class="card-header">
        {{ $user->name }}
    </div>
    
        
    

    


    <div class="card-body">
  
    <h5 class="card-title">{{$freelancer->skills}}</h5>
    <p class="card-text">{{$freelancer->bio}}</p>
      <a href="/messages" class="btn btn-primary">Hire</a>
   
    </div>
  </div>
@endif
@endforeach

@endforeach
</div>

  {{-- <div class="card">
    <div class="card-header">
      Featured
    </div>
    <div class="card-body">
      <h5 class="card-title"></h5>

      <p class="card-text">Video Editing</p>
      <p class="card-text"> 2 years experience in video editing.</p>
      <a href="#" class="btn btn-primary">Hire</a>
    </div>
  </div> --}}

 
   
    
 

  
@endsection