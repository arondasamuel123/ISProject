@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">  
             <form method="POST" action="cinfo" enctype="multipart/form-data"> 
                {{ csrf_field() }}
            <div class="form-group float-label-control">
                <label for="name">Company Name:</label>
                <input  type="text" name="company_name"  class="form-control" >
                
            </div>
     


            <div class="form-group">
            <label>Bio:</label>
            <textarea   name="bio" rows="5" class="form-control"  ></textarea>
               
                </div>

            <div class="form-group">
                            <label for="kra_pin">KRA PIN:</label>
                            <input  type="text" class="form-control" name="kra_pin">
                            
                        </div>

                         <div class="form-group">
                            <label for="name">Company Certificate:</label>
                            <input  type="file" class="form-control"  name="company_cert">
                           
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