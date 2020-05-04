@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
                
             <form method="POST" action="/details">  
              @csrf 
             
            <div class="form-group">
                <label for="name">Project URL:</label>
                <input  type="text" name="project_url"  class="form-control">
              
            </div>
     
            

            <div class="form-group">
            <label>Project Overview:</label>
            <textarea  name="overview" rows="5" class="form-control" ></textarea> 
            
            
                <button style="cursor:pointer" type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
               
                </div>

                {{-- <div class="form-group">
                    <label for="name">University Name:</label>
                    <input  type="text" name="project_url"  class="form-control">
                  
                </div> --}}

            
                <br>
            
           
        
             </form>  
             <div class="form-group" style="text-align:center">
              <a href="/napproval" class="btn btn-success" >
                Continue
              </a>
            </div>
            
        </div>
        {{-- <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Additional portfolio info</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form>
                  @csrf 
                <div class="modal-body">
                    
             
                    <div class="form-group">
                        <label for="name">Project URL:</label>
                        <input  type="text" name="project_url"  class="form-control">
                      
                    </div>
             
                    
        
                    <div class="form-group">
                    <label>Porject Overview:</label>
                    <textarea  name="overview" rows="5" class="form-control" ></textarea> 
          
                                   
                              <br>
                         
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
              </div>
            </div>
          </div> --}}
    </div>
</div>
@endsection