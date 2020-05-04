<!DOCTYPE html>
<html>
<head>
	<title>Approval- Student Gigs</title>

<div class="container">
    			
    			Hello {{$user->name}},
                You have successfully been approved. Click the link below to proceed <br>
                
                
                
              <a href="{{url('/gig/'.$client->client_id)}}">Click here to get started</a><br>
				
				Thank you for choosing Student Gigs.<br>

    		    Regards, 
    		    Student Gigs Support 
    		
    		</div>

    	</head>

    	</html>