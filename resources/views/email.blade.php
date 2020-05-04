<!DOCTYPE html>
<html>
<head>
	<title>Approval- Student Gigs</title>

<div class="container">
    			
    			Hello {{$user->name}},
                You have successfully been approved. Click the link below to proceed 
                
                
                
			  {{-- <a href="{{url('/fdashboard/'.$freelancer->freelancer_id)}}">Click here to get started</a> --}}
			  <a href="{{url('/mount/'.$freelancer->freelancer_id)}}">Click here to get started</a>
				
				Thank you for choosing Student Gigs.

    		    Regards, 
    		    Student Gigs Support 
    		
    		</div>

    	</head>

    	</html>