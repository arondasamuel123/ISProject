@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
              

                
             <form method="POST" action="store">
                {{ csrf_field() }}

                <div class="form-group">
                        
                </div>
             
            <div class="form-group float-label-control">
                <label for="name">Skills:</label>
                <input type="text" name="skills"  class="form-control" >
                
            </div>
     


            <div class="form-group">
            <label>Bio:</label>
            <textarea   name="bio" rows="5" class="form-control" ></textarea>
                
                </div>
            <div class="form-group">
            <label for="level_type">Level type:</label>
                <select   name="level_type" class="form-control">
                 
                <option>Entry</option>
                 <option>Intermediate</option>
                 <option>Expert</option>
                </select>
               

                </div>
                {{-- <div class="form-group">
                        <input type="hidden" name="id" value=""/>  
                <label for="name">Profile Photo:</label>
                <input  type="file" class="form-control"  name="">
               
            </div> --}}
                <br>
            <div class="form-group" style="text-align:center">
                <button style="cursor:pointer" type="submit" class="btn btn-success">Continue</button>
            </div>
           
        
             </form>  
            
        </div>
    </div>
</div>
@endsection