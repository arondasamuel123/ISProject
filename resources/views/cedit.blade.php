@extends('layouts.app')

@section('content')
<table width="40%" align="center" height="60%">
    <tr>
        <td>
    <hr>
        <form action="/update/{{$gig->gig_id}}" method="POST">
          @method("PUT")
          @csrf
      <div class="form-group">

        <label for="title">Gig Title:</label>
      <input type="text" value="{{$gig->gig_name}}" class="form-control" id="taskTitle"  name="gig_name" >
      </div>
      <div class="form-group">
       <label for="title">Gig Description:</label>
        <input type="text" value="{{$gig->gig_description}}" class="form-control" id="taskTitle"  name="gig_description" >
      </div>
      <label for="title">Gig Payment:</label>
        <input type="number" value="{{$gig->gig_payment}}" class="form-control" id="taskTitle"  name="gig_payment" >
        
        <label for="title">Gig Duration:</label>
    
        <select   name="gig_duration" class="form-control">
            <option>1 month</option>   
                <option>2 months</option>
                 <option>3 months</option>
             
                </select>
        <label for="title">Gig Completion:</label>
        <select name="is_complete" class="form-control">
                 
            <option value="0">No</option>
             <option value="1">Yes</option>
         
            </select>
       
      @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
      <td>
    <tr>
</table>
@endsection