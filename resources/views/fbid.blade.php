@extends('layouts.app')

@section('content')
<div class="container">
        @foreach($bids as $bid)
        <div class="card border-primary mb-3">
                <div class="card-header">
                        {{\App\User::where('id', $bid->user_id)->pluck('name')->first()}}
                </div>
                <div class="card-body">
                  
                
               
                  <p class="card-text">{{ $bid->project_period }}</p>
                  <p class="card-text">{{ $bid->cover_letter }}</p>
                  <p class="card-text">ksh{{$bid->amount}}</p>
                  @if($bid->status== 0)
                   <span class="label label-primary">Pending</span>
                  @else 
                  <span class="label label-success">Accepted</span>
                  <br>
                @endif

                <br>
                
                {{-- <a href="/edelete/{{$bid->id}}" class="btn btn-danger">Delete Bid</a> --}}
                <form action="/edelete/{{$bid->id}}" method="POST">
                    @method("DELETE")
                    @csrf
                {{-- <a href="/pdelete/{{$p->id}}" class="btn btn-danger">Delete Project</a>  --}}
                <button type="submit" class="btn btn-danger">Delete Bid</button>
                <a href="/milestones" class="btn btn-primary">View Milestones</a>
                </div>
                
              </div>
        
        @endforeach   
    </div>
    @endsection