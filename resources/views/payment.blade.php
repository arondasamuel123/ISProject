@extends('layouts.app')

@section('content')
<div class="container">
<div class="content">
    <div class="title m-b-md">
             <h3>Payment </h3>
         </div>
<form action="/requestpay" method="POST">
@csrf
{{-- <input type="hidden" name="id" value=""> --}}
    <div class="form-group">
     <input type='text' class="form-control" onkeypress='validate(event)' name="phonenumber" placeholder="254..."  required><br><br>
    </div>
    
 <label>Amount to request Payment</label><br>
 <div class="form-group">
     <input type='text' class="form-control" onkeypress='validate(event)' name="amount" placeholder="Ksh." maxlength="3" required><br><br>
 </div> 
 <input  class="btn btn-primary" type="submit"  value="Make Payment">
</form>
 </div>
</div>
@endsection

<script>
    function validate(evt) {
        var theEvent = evt || window.event;
      
        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]/;
        if( !regex.test(key) ) {
          theEvent.returnValue = false;
          if(theEvent.preventDefault) theEvent.preventDefault();
        }
      }
</script>