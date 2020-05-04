@extends('layouts.app')

@section('content')
<div class="container">
    
        <form  method= "POST" action="/todo">
            @csrf
        <div class="form-group" style="align:center">
            <label for="name">Add Milestone:</label>
            <input type="text" name="milestone"  class="form-control">
            
        </div>
        <div class="form-group" style="text-align:center">
            <button style="cursor:pointer" type="submit" class="btn btn-success">ADD</button>
        </div>
        <div class="form-group" style="text-align:center">
                <a style="cursor:pointer" href="/todos" class="btn btn-primary">VIEW MIELSTONES</a>
            </div>
    </form>
    
    {{-- <div class="card">
     <div class="card-header">
            
        </div>
        <div class="card-body">
                <ul id="myUL">
                <input type="checkbox"></input> <br>
                        <input type="checkbox">Add milestone 1</input> <br>
                        <input type="checkbox">Add milestone 2</input> <br>
                        <input type="checkbox">Add milestone 3</input> <br>
                        <input type="checkbox">Add milestone 4</input> <br>
                       
                      </ul>
      
          <a href="#" class="btn btn-primary">End Project</a>
       
        </div>
      </div> --}}
    
</div>

@endsection