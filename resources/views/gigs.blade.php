@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
                
        <form method="POST" action="/gigstore">
                {{ csrf_field() }}

                <div class="form-group">
                        
                </div>
             
            <div class="form-group float-label-control">
                <label for="name">Gig Title:</label>
                <input type="text" name="gig_name"  class="form-control"  >
                
            </div>
     
            <div class="form-group">
            <label>Gig Description:</label>
            <textarea   name="gig_description" rows="5" class="form-control" ></textarea>
                
                </div>
            <div class="form-group">
            <label for="level_type">Gig Duration :</label>
                <select   name="gig_duration" class="form-control">
                 
                <option>1 month</option>
                 <option>2 months</option>
                 <option>3 months</option>
                </select>
               

                </div>
                <div class="form-group float-label-control">
                    <label for="name">Gig Payment:</label>
                    <input type="number" name="gig_payment"  class="form-control" >
                    
                </div>
                <br>
            <div class="form-group" style="text-align:center">
                <button style="cursor:pointer" type="submit" class="btn btn-success">Continue</button>
            </div>
           
        
             </form>  
            
        </div>
    </div>
</div>
@endsection