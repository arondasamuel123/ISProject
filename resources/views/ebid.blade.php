@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">                
             <form method="POST" action="/bupdate/{{$bid->id}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    
                    <label for="level_type">How long will it take:</label>
                        <select  name="project_period" class="form-control" >
                        <option>{{$bid->project_period}}</option>
                        <option>1 month</option>
                         <option>3 months</option>
                         <option>4-6 months</option>
                        </select>
                       
        
                        </div>
                    {{-- <input type="hidden" name="id" value="{{$id}}"> --}}
     

            <div class="form-group">
            <label>Letter of Application</label>
            <textarea   name="cover_letter" rows="5" class="form-control">{{$bid->cover_letter}}</textarea>
                
                </div>

            <div class="form-group">
                            <label for="amount">How much are willing to charge?</label>   
            <input  type="number" value="{{$bid->amount}}" class="form-control" name="amount">
                           
                        </div>
                        <div class="form-group">
                            <label>Accept or Reject?:</label>
                            <select  name="status">
                            <option value="{{$bid->status}}">Pending</option>
                              <option value="1" >Accept</option>
                              <option value="2" >Reject</option>
                            
                             
                            </select>
                        </div>

    
                <br>
            <div class="form-group" style="text-align:center">
                <button style="cursor:pointer"  class="btn btn-success">Continue</button>
            </div>
            <div class="form-group" style="text-align:center">
                <a href= "/bshow" style="cursor:pointer"  class="btn btn-primary">Back</a>
            </div>
        
             </form>  
            
        </div>
    </div>
</div>

@endsection