@extends('layouts.app')

@section('content')
<div class="container">

@foreach($portfolios as $p)
<div class="card border-danger mb-3">
    <div class="card-header">
        {{\App\User::where('id', $p->user_id)->pluck('name')->first()}}
    </div>
    <div class="card-body">
      
    
    <h5 class="card-title">{{$p->project_url}}</h5>
      <p class="card-text">{{$p->overview}}</p>
      
      <form action="/pdelete/{{$p->id}}" method="POST">
        @method("DELETE")
        @csrf
    {{-- <a href="/pdelete/{{$p->id}}" class="btn btn-danger">Delete Project</a>  --}}
    <button type="submit" class="btn btn-danger">Delete Project</button>
      </form>
    </div>
   
    
   
  </div>
  @endforeach
 
  
</div>
<div class="form-grouo">
    <a href="/fdashboard" class="btn btn-primary">Back</a>
    <a href="/portfolio" class="btn btn-success">Add Project</a>

  </div>
@endsection