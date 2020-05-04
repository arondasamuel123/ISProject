@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">                
             <form method="POST" action="/bids">
                @csrf
                <div class="form-group">
                    
                    <label for="level_type">How long will it take:</label>
                        <select  name="project_period" class="form-control" >
                            <option>Months....</option>
                        <option>1 month</option>
                         <option>3 months</option>
                         <option>4-6 months</option>
                        </select>
                       
        
                        </div>
                    <input type="hidden" name="id" value="{{$id}}">
     

            <div class="form-group">
            <label>Letter of Application</label>
            <textarea   name="cover_letter" rows="5" class="form-control"></textarea>
                
                </div>

            <div class="form-group">
                            <label for="amount">How much are willing to charge?</label>   
                            <input  type="number" class="form-control" name="amount">
                           
            </div>

    
                <br>
            <div class="form-group" style="text-align:center">
                <button style="cursor:pointer"  class="btn btn-success">Continue</button>
            </div>
           
        
             </form>  
            
        </div>
    </div>
</div>

@endsection